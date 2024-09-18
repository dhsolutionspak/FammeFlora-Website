<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderHistory;
use App\Models\PaymentMethods;
use App\Models\Shipping;
use App\Models\OrderTax;
use App\Models\StoreProductOption;
use Validator;
use File;
use DB;
use Auth;
use Carbon;
use Notification;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Razorpay\Api\Api;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Str;
use App\Notification\PanelNotification;
use Paystack;
use Instamojo;
use Mail;

class CartController extends Controller
{
  private $getUser;
  private $stripe;
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $this->getUser = Auth::guard('customer')->user();
      return $next($request);
    });
  }

  //addToCart api
  public function addToCart(Request $request)
  {
    try {
      $getProduct = Product::with('special:product_id,price,start_date,end_date')->findOrFail($request->product_id);
      $productBasePrice = $getProduct->price;

      //check product exists or not
      if ($getProduct) {
        //check this product already in cart

        //product special
        $price = $getProduct->price;
        $special = 0;
        if ($getProduct->special) {
          $endDate = Carbon\Carbon::createFromFormat('m/d/Y', $getProduct->special->end_date);
          $startDate = Carbon\Carbon::createFromFormat('m/d/Y', $getProduct->special->start_date);
          $todayDate = Carbon\Carbon::createFromFormat('m/d/Y', date('m/d/y'));
          if ($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
            $special = number_format($getProduct->special->price, 2);
          }
        }

        if ($special > 0) {
          $productBasePrice = $special;
        }

        //check product has options
        $findProductOption = StoreProductOption::where('product_id', $request->product_id)->first();

        //find option send or not
        if ($findProductOption != null && $request->options == null) {
          $productData['product'] = Product::select('id', 'manufacturer_id', 'image', 'category_id', 'model', 'price', 'location', 'quantity', 'sort_order', 'status', 'length', 'width', 'height')
            ->with('productDescription:name,id,product_id,description', 'category:name,category_id', 'productManufacturer:id,image')
            ->where('id', $request->product_id)->first();

          $productOptionsData = StoreProductOption::where('product_id', $request->product_id)
            ->join('product_options', 'product_options.id', '=', 'store_product_option.option_id')
            ->with('productoptionDescription:name,option_id')
            ->select('store_product_option.*', 'product_options.type')
            ->get();

          $productOptions = [];
          $optionName = '';
          foreach ($productOptionsData as $key => $value) {
            $productOptions[$value->type . '-' . $value->productoptionDescription?->name][] = $value;
          }

          $productData['productOptions'] = $productOptions;

          return ['status' => 3, 'productData' => $productData, 'price' => $price, 'special' => $special];
        } else {

          if ($request->price > 0) {
            $productBasePrice = $request->price;
          }

          //get getCustomerCart
          $getCustomerCart = DB::table('cart')->where('session_id', session()->getId())->where('product_id', $request->product_id)
            ->where('option', $request->options)
            ->first();

          //if already product in cart then update
          if ($getCustomerCart) {

            $qty = $getProduct->quantity + $getCustomerCart->quantity;

            // check stock
            if ($qty >= $request->quantity) {
              $storeOption = null;
              if ($findProductOption) {
                $storeOption = $request->options;
              }

              //update
              DB::table('cart')->where('cart_id', $getCustomerCart->cart_id)
                ->update(['quantity' => $getCustomerCart->quantity + $request->quantity, 'option' => $storeOption, 'base_price' => $productBasePrice]);

              //increment product quantity
              Product::where('id', $getCustomerCart->product_id)->update(['quantity' => $qty]);

              //decrement product quantity
              $minusQty = $getCustomerCart->quantity + $request->quantity;
              Product::where('id', $request->product_id)
                ->update(['quantity' => $qty - $minusQty]);

              $cartCount = DB::table('cart')->where('session_id', session()->getId())->sum('quantity');

              return ['status' => 1, 'message' => 'Product Added To Cart!', 'cartCount' => $cartCount];
            } else {
              return ['status' => 0, 'message' => 'Only ' . $getProduct->quantity . ' products in stock'];
            }
          }
          //insert product to cart
          else {

            $storeOption = null;
            if ($findProductOption) {
              $storeOption = $request->options;
            }

            // check stock
            if ($getProduct->quantity >= $request->quantity) {
              DB::table('cart')->insert([
                'product_id' => $request->product_id,
                'customer_id' => $this->getUser ? $this->getUser->id : 0,
                'quantity' => $request->quantity,
                'date_added' => date('Y-m-d H:i:s'),
                'option' => $storeOption,
                'base_price' => $productBasePrice,
                'session_id' => session()->getId()
              ]);
              //decrement product quantity
              Product::where('id', $request->product_id)->update(['quantity' => $getProduct->quantity - $request->quantity]);
              $cartCount = DB::table('cart')->where('session_id', session()->getId())->sum('quantity');
              return ['status' => 1, 'message' => 'Product Added To Cart!', 'cartCount' => $cartCount];
            } else {
              return ['status' => 0, 'message' => 'Only ' . $getProduct->quantity . ' products in stock'];
            }
          }
        }

      } else {
        return ['status' => 0, 'message' => 'Product not found!'];
      }

    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }
  }

  //get cart
  public function getCart()
  {

    try {
      $cartDetails = $this->getCartData();
      $this->buildSeo('Shopping Cart', [config('settingConfig.config_store_name'), 'Cart'], url()->current(), '');

      //return view('frontend.cart.shoppingcart',['status'=> 1,'cartData' => $cartData,'subTotal' =>number_format($cartTotal,2) ,'discount' => $discount,'taxes' => $taxRates,'grandTotal' => $grandTotal,'couponData' => $counponHistory,'discountAMT' => $discountAMT]);
      return view('frontend.cart.shoppingcart', $cartDetails);


    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  //update cart
  public function updateCart(Request $request)
  {
    try {
      //get cart
      $getCart = DB::table('cart')->where('cart_id', $request->cart_id)->first();
      if ($getCart) {

        //get product
        $getProduct = Product::findOrFail($getCart->product_id);

        $qty = $getProduct->quantity + $getCart->quantity;

        // check stock
        if ($qty >= $request->quantity) {

          //update
          DB::table('cart')->where('cart_id', $getCart->cart_id)->update(['quantity' => $request->quantity]);

          //increment product quantity
          Product::where('id', $getCart->product_id)->update(['quantity' => $qty]);

          //decrement product quantity
          $minusQty = $getCart->quantity + $request->quantity;

          Product::where('id', $getCart->product_id)
            ->update(['quantity' => $qty - $request->quantity]);

          //build cart
          $rmsg = 'Cart successfully updated!';
          $cartCount = DB::table('cart')->where('session_id', session()->getId())->sum('quantity');
          $cartRecord = $this->getCartData();

          return [
            'status' => 1,
            'message' => $rmsg,
            'cartData' => $cartRecord['cartData'],
            'cartCount' => $cartCount,
            'subTotal' => $cartRecord['subTotal'],
            'discount' => $cartRecord['discount'],
            'grandTotal' => $cartRecord['grandTotal'],
            'taxes' => $cartRecord['taxes']
          ];

        } else {
          return ['status' => 0, 'message' => 'Only ' . $getProduct->quantity . ' products in stock'];
        }
      } else {
        return ['status' => 0, 'message' => 'Error'];
      }
    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }
  }

  //update cart
  public function deleteCart(Request $request)
  {

    //get cart
    $getCart = DB::table('cart')->where('cart_id', $request->cart_id)->first();
    if ($getCart) {
      //get product
      $getProduct = Product::findOrFail($getCart->product_id);

      $qty = $getProduct->quantity + $getCart->quantity;

      //update
      DB::table('cart')->where('cart_id', $getCart->cart_id)->delete();

      //increment product quantity
      Product::where('id', $getCart->product_id)->update(['quantity' => $qty]);

      //get cart after deleted all items
      $getCart = DB::table('cart')->where('cart_id', $request->cart_id)->first();
      if (!$getCart) {
        DB::table('coupon_history')->where('session_id', session()->getId())->where('order_done', 0)->update(['order_done' => 1]);
      }

      //build cart
      $rmsg = 'Cart successfully deleted!';
      $cartCount = DB::table('cart')->where('session_id', session()->getId())->sum('quantity');
      $cartRecord = $this->getCartData();

      return [
        'status' => 1,
        'message' => $rmsg,
        'cartData' => $cartRecord['cartData'],
        'cartCount' => $cartCount,
        'subTotal' => $cartRecord['subTotal'],
        'discount' => $cartRecord['discount'],
        'grandTotal' => $cartRecord['grandTotal'],
        'taxes' => $cartRecord['taxes']
      ];

    } else {
      return ['status' => 0, 'message' => 'Error'];
    }
  }

  //apply coupon
  public function applyCoupon(Request $request)
  {
    try {
      //check coupon exists
      $getCoupon = DB::table('coupon')->where('code', $request->couponCode)->first();
      $discount = null;
      $taxRates = [];
      $discountAmt = 0.00;

      $sessionCartData = session()->get('cart' . session()->getId());
      if (count($sessionCartData) > 0) {
        //find coupon
        $counponHistory = DB::table('coupon_history')->where('session_id', session()->getId())->where('order_done', 0)->first();
        $grandTotal = str_replace(",", "", $sessionCartData['grandTotal']);
        if ($getCoupon && date('Y-m-d', strtotime($getCoupon->start_date)) <= date('Y-m-d') && date('Y-m-d', strtotime($getCoupon->end_date)) >= date('Y-m-d')) {
          //calculate discount
          $discountTxt = '';
          if ($getCoupon->type == 1) {
            $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

            $discountAmt = $subTotal / 100 * $getCoupon->discount;
            $discountTxt = number_format($getCoupon->discount, 2) . '%';
          } else {
            $discountAmt = $getCoupon->discount;
            $discountTxt = number_format($getCoupon->discount, 2);
          }

          if ($sessionCartData['discount']) {
            if ($sessionCartData['discount']['name'] != $request->couponCode . ' (' . $discountTxt . ')') {
              $grandTotal = $grandTotal - $discountAmt;
              $discount = ['name' => 'Discount (' . $discountTxt . ')', 'discountAmt' => number_format($discountAmt, 2)];
            } else {
              $grandTotal = str_replace(',', '', $sessionCartData['grandTotal']);
              $discount = $sessionCartData['discount'];
            }
          } else {
            $grandTotal = $grandTotal - $discountAmt;
            $discount = ['name' => 'Discount (' . $discountTxt . ')', 'discountAmt' => number_format($discountAmt, 2), 'type' => $getCoupon->type, 'discount' => $getCoupon->discount];
          }
          if ($counponHistory) {
            //update
            DB::table('coupon_history')->where('order_done', 0)->where('session_id', session()->getId())->update([
              'coupon_id' => $getCoupon->id,
              'coupon_type' => $getCoupon->type,
              'amount' => $getCoupon->type == 1 ? $getCoupon->discount : $discountAmt,
              'date_added' => date('Y-m-d'),
              'is_valid' => true,
              'coupon_code' => $getCoupon->code
            ]);
          } else {
            //insert
            DB::table('coupon_history')->insert(['coupon_id' => $getCoupon->id, 'coupon_type' => $getCoupon->type, 'session_id' => session()->getId(), 'customer_id' => $this->getUser ? $this->getUser->id : 0, 'amount' => $getCoupon->type == 1 ? $getCoupon->discount : $discountAmt, 'date_added' => date('Y-m-d'), 'is_valid' => true, 'coupon_code' => $getCoupon->code]);
          }

          return ['status' => 1, 'message' => "Coupon successfully applied!", 'discount' => $discount, 'discountType' => $getCoupon->type, 'discountPer' => number_format($getCoupon->discount, 2), 'grandTotal' => number_format($grandTotal, 2)];
        } else {
          if ($counponHistory) {
            // if($counponHistory->is_valid){
            //   $grandTotal += $counponHistory->amount;
            // }
            DB::table('coupon_history')->where('order_done', 0)->where('session_id', session()->getId())->update(['is_valid' => false]);
          }
          return ['status' => 0, 'message' => 'Coupon expired/Invalid!', 'grandTotal' => number_format($grandTotal, 2)];
        }
      } else {
        if ($counponHistory) {
          // if($counponHistory->is_valid){
          //   $grandTotal += $counponHistory->amount;
          // }
          DB::table('coupon_history')->where('order_done', 0)->where('session_id', session()->getId())->update(['is_valid' => false]);
        }
        return ['status' => 2, 'message' => 'Invalid coupon code'];
      }

    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }

  }

  //get checkout page
  public function getCheckout()
  {
    try {

      $data = [];
      $data['shippingMethods'] = Shipping::where('status', 1)->get();
      $data['addresses'] = [];
      //remove tax sesison data
      session()->forget('TAX_DATA' . session()->getId());
      $addressQuery = DB::table('customer_address')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->join('states', 'states.state_id', '=', 'customer_address.state_id')
        ->select('customer_address.*', 'country.name as country', 'states.name as state');

      if ($this->getUser) {
        $addressQuery = $addressQuery->where('customer_id', $this->getUser->id);
      } else {
        $addressQuery = $addressQuery->where('session_id', session()->getId());
      }

      $data['addresses'] = $addressQuery->get();

      $data['countries'] = Country::where('status', '1')->select('id', 'name', 'iso_code_3', 'postcode_required', 'status')->orderBy('name', 'ASC')->get();
      $sessionCartData = session()->get('cart' . session()->getId());
      $data['cartData'] = $sessionCartData;

      //check coupon
      $counponHistory = DB::table('coupon_history')
        ->where('is_valid', 1)
        ->where('session_id', session()->getId())
        ->where('order_done', 0)
        ->first();

      $grandTotal = $sessionCartData['grandTotal'];
      $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

      $discountAMT = 0;
      if ($counponHistory) {
        if ($counponHistory->coupon_type == 1) {

          $discountAMT = $subTotal / 100 * $counponHistory->amount;
        } else {
          $discountAMT = $counponHistory->amount;
        }
      }

      $data['discount'] = number_format($discountAMT, 2);

      $getCart = DB::table('cart')->where('session_id', session()->getId())->get();
      if (count($getCart) > 0) {
        $data['orderProducts'] = Product::select(
          'product.price',
          'product.id',
          'product.model',
          'product.image',
          'cart.quantity',
          'cart.cart_id',
          'cart.base_price',
          'tax_rate.rate',
          'tax_rate.type',
          'tax_rate.name as taxName',
          'tax_rate.status as taxStatus',
          'cart.option'
        )
          ->join('cart', 'cart.product_id', '=', 'product.id')
          ->with('productDescription:name,id,product_id')
          ->leftjoin('tax_rate', 'tax_rate.id', '=', 'product.tax_rate_id')
          ->orderBy('cart.date_added', 'DESC')
          ->where('cart.session_id', session()->getId())
          ->get();

      }

      //payment methods
      $data['paymentMethods'] = PaymentMethods::orderBy('sort_order', 'ASC')->where('is_active', 1)->get();

      //payment keys
      $data['STRIPE_KEY'] = PaymentMethods::where('payment_code', 'stripe')->select('payment_key', 'payment_secret')->first();
      $data['RAZORPAY_KEY'] = PaymentMethods::where('payment_code', 'razorpay')->select('payment_key', 'payment_secret')->first();

      $this->buildSeo('Checkout', ['otrixcommerce', 'Checkout'], url()->current(), '');


      return view('frontend.cart.checkout', compact('data'));
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  //when select shipping method
  public function selectShipping(Request $request)
  {
    try {
      $findShipping = Shipping::findOrFail($request->id);
      $findTax = session()->get('TAX_DATA' . session()->getId());

      //get cart data
      $sessionCartData = session()->get('cart' . session()->getId());

      if ($sessionCartData) {

        if (array_key_exists('shipping', $sessionCartData)) {
          $grandTotal = str_replace(",", "", $sessionCartData['grandTotal']);
          $grandTotal = $grandTotal - $sessionCartData['shipping']['charges'];
          $grandTotal = $grandTotal + $findShipping->shipping_charge;

        } else {
          $grandTotal = str_replace(",", "", $sessionCartData['grandTotal']);
          $grandTotal = $grandTotal + $findShipping->shipping_charge;
        }

        $shipping = [
          'name' => $findShipping->name,
          'charges' => $findShipping->shipping_charge,
          'id' => $findShipping->id
        ];

        $newSessionData = [
          'cartData' => $sessionCartData['cartData'],
          'subTotal' => $sessionCartData['subTotal'],
          'discount' => $sessionCartData['discount'],
          'taxes' => $sessionCartData['taxes'],
          'grandTotal' => $grandTotal,
          'products' => $sessionCartData['products'],
          'shipping' => $shipping
        ];

        session()->put('cart' . session()->getId(), $newSessionData);
        session()->save();

        //check coupon
        $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
          ->where('order_done', 0)->first();
        $discountAMT = 0;
        $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

        if ($counponHistory) {
          if ($counponHistory->coupon_type == 1) {
            $discountAMT = $subTotal / 100 * $counponHistory->amount;
            $grandTotal -= $discountAMT;
          } else {
            $discountAMT = $counponHistory->amount;
            $grandTotal -= $discountAMT;
          }
        }

        return ['status' => 1, 'shipping' => $shipping, 'orderSummary' => $sessionCartData['cartData'], 'grandTotal' => $grandTotal, 'taxData' => $findTax];
      } else {
        return ['status' => 1, 'message' => 'Session expired add products again!'];
      }
    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }
  }

  //create session stripe payment
  public function createStripePaymentIntent(Request $request)
  {

    $sessionCartData = session()->get('cart' . session()->getId());
    $getMaxNumber = Order::max('id');
    $getAddress = DB::table('customer_address')
      ->join('country', 'country.id', '=', 'customer_address.country_id')
      ->select('customer_address.*', 'country.name as country', 'country.iso_code_2')
      ->where('customer_address.id', $request->address_id)
      ->first();

    $grandTotal = $sessionCartData['grandTotal'];
    //check coupon
    $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
      ->where('order_done', 0)->first();
    $discountAMT = 0;
    if ($counponHistory) {
      if ($counponHistory->coupon_type == 1) {
        $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

        $discountAMT = $subTotal / 100 * $counponHistory->amount;
        $grandTotal -= $discountAMT;
      } else {
        $discountAMT = $counponHistory->amount;
        $grandTotal -= $discountAMT;
      }
    }

    $findPaymentMethod = PaymentMethods::where('payment_code', 'stripe')->first();
    $this->stripe = new StripeClient($findPaymentMethod->payment_secret);

    $intent = $this->stripe->paymentIntents->create([
      "amount" => $grandTotal * 100,
      "currency" => "usd",
      'payment_method_types' => ['card'],
      'metadata' => ['integration_check' => 'accept_a_payment'],
      "description" => config('settingConfig.config_store_name') . " Product Purchase Payment",
      "shipping" => [
        "name" => $getAddress->name,
        "address" => [
          "line1" => $getAddress->address_1,
          "postal_code" => $getAddress->postcode,
          "city" => $getAddress->city,
          "country" => $getAddress->iso_code_2,
        ],
      ]
    ]);

    $data = array(
      'name' => $this->getUser->firstname,
      'email' => $this->getUser->email,
      'amount' => $grandTotal,
      'client_secret' => $intent->client_secret,
    );
    return $data;
  }

  //place order
  public function placeOrder(Request $request)
  {
    try {
      $findPaymentMethod = PaymentMethods::where('payment_code', 'paystack')->first();

      $sessionCartData = session()->get('cart' . session()->getId());
      $getMaxNumber = Order::max('id');
      $getAddress = DB::table('customer_address')->whereId($request->address_id)->first();
      $getBillingAddress = DB::table('customer_address')->whereId($request->billing_address_id)->first();
      $oaymentMethod = '';
      $grandTotal = $sessionCartData['grandTotal'];
      $findShipping = Shipping::find($request->selectedShippingMethod);

      //check coupon
      $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
        ->where('order_done', 0)->first();
      $discountAMT = 0;
      if ($counponHistory) {
        $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

        if ($counponHistory->coupon_type == 1) {
          $discountAMT = $subTotal / 100 * $counponHistory->amount;
          $grandTotal -= $discountAMT;
        } else {
          $discountAMT = $counponHistory->amount;
          $grandTotal -= $discountAMT;
        }
      }

      //add tax to grandTotal
      $calculateTaxAmount = [];
      if (isset($request->address_id)) {
        $calculateTaxAmount = $this->calculateZoneTax($request->address_id);
      } else {
        $calculateTaxAmount = $this->calculateZoneTax($request->billing_address_id);
      }

      $taxTotalAmount = 0;
      if (count($calculateTaxAmount['tax']) > 0) {
        foreach ($calculateTaxAmount['tax'] as $key => $value) {
          $taxTotalAmount += $value['taxAmount'];
        }
      }

      $grandTotal += $taxTotalAmount;

      //pay using stripe
      if ($request->payment_method == 'stripe') {
        $paymentMethod = 'Credit/Debit Card (Stripe Payment Geteway)';
        //verify payment
        try {
          $findPaymentMethod = PaymentMethods::where('payment_code', 'stripe')->first();
          $this->stripe = new StripeClient($findPaymentMethod->payment_secret);
          $this->stripe->paymentIntents->retrieve(
            $request->tid,
            []
          );
        } catch (\Exception $e) {
          return redirect()->back()->with('commonError', 'Payment not verified');
        }
      }

      //pay using razorpay
      if ($request->payment_method == 'razorpay') {
        $paymentMethod = 'Razorpay Payment Geteway';
        $findPaymentMethod = PaymentMethods::where('payment_code', 'razorpay')->first();
        $api = new Api($findPaymentMethod->payment_key, $findPaymentMethod->payment_secret);
        $payment = $api->payment->fetch($request->tid);
        try {
          $response = $api->payment->fetch($request->tid)->capture(array('amount' => $payment['amount']));
        } catch (\Exception $e) {
          return redirect()->back()->with('commonError', $e->getMessage());
        }
      }
      //pay using paypal
      if ($request->payment_method == 'paypal') {
        $paymentMethod = 'Paypal Payment Geteway';

        $provider = new PayPalClient;
        $provider->setApiCredentials($this->paypalConfig());
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
          "intent" => "CAPTURE",
          "application_context" => [
            "return_url" => route('paypal.successTransaction'),
            "cancel_url" => route('paypal.cancelTransaction'),
          ],
          "purchase_units" => [
            0 => [
              "amount" => [
                "currency_code" => "USD",
                "value" => $grandTotal
              ]
            ]
          ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
          // redirect to approve href
          foreach ($response['links'] as $links) {
            if ($links['rel'] == 'approve') {
              session()->put('SHIPPING_DATA', $findShipping->name);
              session()->put("ORDER_DATA", $request->all());
              session()->save();
              return redirect()->away($links['href']);
            }
          }
          return redirect()
            ->back()
            ->with('commonError', 'Something went wrong.');
        } else {
          return redirect()
            ->back()
            ->with('commonError', $response['message'] ?? 'Something went wrong.');
        }
      }


      //mollie payment Geteway
      if ($request->payment_method == 'mollie') {
        $generateTrx = Str::random(30);
        $findPaymentMethod = PaymentMethods::where('payment_code', 'mollie')->first();

        Mollie::api()->setApiKey($findPaymentMethod->payment_key);
        $payment = Mollie::api()->payments->create([
          "amount" => [
            "currency" => "USD",
            "value" => number_format($grandTotal, 2) // You must send the correct number of decimals, thus we enforce the use of strings
          ],
          "description" => "Order #" . $getMaxNumber,
          "redirectUrl" => route('mollie.success'),
          "webhookUrl" => route('webhooks.mollie'),
          "metadata" => [
            "order_id" => $generateTrx,
          ],
        ]);

        session()->put('TRX_ID', $generateTrx);
        session()->put('SHIPPING_DATA', $findShipping->name);
        session()->put("ORDER_DATA", $request->all());
        session()->save();
        return redirect($payment->getCheckoutUrl(), 303);
      }

      //pay using Paystack
      if ($request->payment_method == 'paystack') {
        $generateTrx = Str::random(30);
        session()->put('TRX_ID', $generateTrx);
        session()->put('SHIPPING_DATA', $findShipping->name);
        session()->put("ORDER_DATA", $request->all());
        session()->save();

        $data = array(
          "amount" => $grandTotal * 100,
          "reference" => $generateTrx,
          "email" => $this->getUser ? $this->getUser->email : $getBillingAddress->email,
          "currency" => "ZAR",
          "orderID" => $getMaxNumber,
        );

        return Paystack::getAuthorizationUrl($data)->redirectNow();
      }

      //pay using instamojo
      if ($request->payment_method == 'instamojo') {
        $generateTrx = Str::random(30);
        $findPaymentMethod = PaymentMethods::where('payment_code', 'instamojo')->first();

        session()->put('TRX_ID', $generateTrx);
        session()->put('SHIPPING_DATA', $findShipping->name);
        session()->put("ORDER_DATA", $request->all());
        session()->save();

        $api = new Instamojo\Instamojo(
          $findPaymentMethod->payment_key,
          $findPaymentMethod->payment_secret,
          $findPaymentMethod->payment_url,
        );

        try {

          $response = $api->paymentRequestCreate(
            array(
              "purpose" => "Order Create",
              "amount" => $grandTotal,
              "buyer_name" => $this->getUser ? $this->getUser->firstname : $getBillingAddress->name,
              "send_email" => true,
              "email" => $this->getUser ? $this->getUser->email : $getBillingAddress->email,
              "phone" => $this->getUser ? $this->getUser->telephone : $getBillingAddress->mobile,
              "redirect_url" => route('instamojo.success')
            )
          );

          return redirect($response['longurl'], 303);
        } catch (Exception $e) {
          //error
        }
      }

      if ($request->payment_method == 'cod') {
        $paymentMethod = 'Cash On Delivery';
      }

      //make stripe payment method 2
      //$charge = $this->createCharge($request->stripeToken, $grandTotal,$getAddress);

      $paymentDone = 0;
      if (!empty($charge) && $charge['status'] == 'succeeded') {
        $paymentDone = 1;
      } else {
        $paymentDone = 0;
      }


      $this->placeOrderCommon($request, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT, $getBillingAddress, $getAddress, $findShipping->name, 0, $calculateTaxAmount['tax']);
      return redirect('/payment-success');

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  //paypal success function
  public function paypalSuccess(Request $request)
  {

    $provider = new PayPalClient;
    $provider->setApiCredentials($this->paypalConfig());
    $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request['token']);
    if (isset($response['status']) && $response['status'] == 'COMPLETED') {

      /****************************************************
              complete order after payment success
      ******************************************************/

      $getSessionRequests = session()->get('ORDER_DATA');
      $shippingMethod = session()->get('SHIPPING_DATA');

      $paymentMethod = 'Paypal Payment Geteway';
      $sessionCartData = session()->get('cart' . session()->getId());
      $getMaxNumber = Order::max('id');
      $getAddress = DB::table('customer_address')->whereId(isset($getSessionRequests['address_id']) ? $getSessionRequests['address_id'] : $getSessionRequests['billing_address_id'])->first();
      $getBillingAddress = DB::table('customer_address')->whereId($getSessionRequests['billing_address_id'])->first();

      $oaymentMethod = '';
      $grandTotal = $sessionCartData['grandTotal'];

      //check coupon
      $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
        ->where('order_done', 0)->first();
      $discountAMT = 0;
      if ($counponHistory) {
        if ($counponHistory->coupon_type == 1) {
          $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

          $discountAMT = $subTotal / 100 * $counponHistory->amount;
          $grandTotal -= $discountAMT;
        } else {
          $discountAMT = $counponHistory->amount;
          $grandTotal -= $discountAMT;
        }
      }

      $paymentDone = 0;
      if (!empty($charge) && $charge['status'] == 'succeeded') {
        $paymentDone = 1;
      } else {
        $paymentDone = 0;
      }

      //add tax to grandTotal
      $calculateTaxAmount = [];
      if (isset($getSessionRequests['address_id'])) {
        $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['address_id']);
      } else {
        $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['billing_address_id']);
      }

      $taxTotalAmount = 0;
      if (count($calculateTaxAmount['tax']) > 0) {
        foreach ($calculateTaxAmount['tax'] as $key => $value) {
          $taxTotalAmount += $value['taxAmount'];
        }
      }

      $grandTotal += $taxTotalAmount;

      $this->placeOrderCommon($getSessionRequests, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT, $getBillingAddress, $getAddress, $shippingMethod, $request->PayerID, $calculateTaxAmount['tax']);

      return redirect('/payment-success');

    } else {
      return redirect()
        ->route('checkout')
        ->with('commonError', $response['message'] ?? 'Something went wrong.');
    }
  }

  //when mollie payment success
  public function mollieSuccess(Request $request)
  {

    $getTrx = session()->get('TRX_ID');
    if ($getTrx) {
      $findMolliePayment = DB::table("molie_payment_tracking")->where('trx_id', $getTrx)->first();
      if ($findMolliePayment) {
        if ($findMolliePayment->payment_status == 1) {
          /****************************************************
                  complete order after payment success
          ******************************************************/
          $getSessionRequests = session()->get('ORDER_DATA');
          $shippingMethod = session()->get('SHIPPING_DATA');
          $paymentMethod = 'Mollie Payment Geteway';
          $sessionCartData = session()->get('cart' . session()->getId());

          $getMaxNumber = Order::max('id');
          $getAddress = DB::table('customer_address')->whereId(isset($getSessionRequests['address_id']) ? $getSessionRequests['address_id'] : $getSessionRequests['billing_address_id'])->first();
          $getBillingAddress = DB::table('customer_address')->whereId($getSessionRequests['billing_address_id'])->first();
          $oaymentMethod = '';
          $grandTotal = $sessionCartData['grandTotal'];

          //check coupon
          $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
            ->where('order_done', 0)->first();
          $discountAMT = 0;
          if ($counponHistory) {
            if ($counponHistory->coupon_type == 1) {
              $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

              $discountAMT = $subTotal / 100 * $counponHistory->amount;
              $grandTotal -= $discountAMT;
            } else {
              $discountAMT = $counponHistory->amount;
              $grandTotal -= $discountAMT;
            }
          }


          $paymentDone = 0;
          if (!empty($charge) && $charge['status'] == 'succeeded') {
            $paymentDone = 1;
          } else {
            $paymentDone = 0;
          }

          //add tax to grandTotal
          $calculateTaxAmount = [];
          if (isset($getSessionRequests['address_id'])) {
            $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['address_id']);
          } else {
            $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['billing_address_id']);
          }

          $taxTotalAmount = 0;
          if (count($calculateTaxAmount['tax']) > 0) {
            foreach ($calculateTaxAmount['tax'] as $key => $value) {
              $taxTotalAmount += $value['taxAmount'];
            }
          }

          $grandTotal += $taxTotalAmount;

          $this->placeOrderCommon($getSessionRequests, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT, $getBillingAddress, $getAddress, $shippingMethod, $findMolliePayment->payment_id, $calculateTaxAmount['tax']);
          return redirect('/payment-success');

        } else {
          return redirect()
            ->route('checkout')
            ->with('commonError', 'Payment failed!');
        }
      } else {
        return redirect()
          ->route('checkout')
          ->with('commonError', 'Something went wrong.');
      }
    } else {
      return redirect()
        ->route('checkout')
        ->with('commonError', 'Something went wrong.');
    }

  }

  public function paystackSuccess()
  {
    $paymentDetails = Paystack::getPaymentData();

    if (isset($paymentDetails['data'])) {
      if ($paymentDetails['data']['status'] == 'success') {
        $getSessionRequests = session()->get('ORDER_DATA');
        $shippingMethod = session()->get('SHIPPING_DATA');
        $paymentMethod = 'Pay Stack Payment Geteway';
        $sessionCartData = session()->get('cart' . session()->getId());

        $getMaxNumber = Order::max('id');
        $getAddress = DB::table('customer_address')->whereId(isset($getSessionRequests['address_id']) ? $getSessionRequests['address_id'] : $getSessionRequests['billing_address_id'])->first();
        $getBillingAddress = DB::table('customer_address')->whereId($getSessionRequests['billing_address_id'])->first();
        $oaymentMethod = '';
        $grandTotal = $sessionCartData['grandTotal'];

        //check coupon
        $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
          ->where('order_done', 0)->first();
        $discountAMT = 0;
        if ($counponHistory) {
          if ($counponHistory->coupon_type == 1) {
            $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

            $discountAMT = $subTotal / 100 * $counponHistory->amount;
            $grandTotal -= $discountAMT;
          } else {
            $discountAMT = $counponHistory->amount;
            $grandTotal -= $discountAMT;
          }
        }


        $paymentDone = 0;
        if (!empty($charge) && $charge['status'] == 'succeeded') {
          $paymentDone = 1;
        } else {
          $paymentDone = 0;
        }

        //add tax to grandTotal
        $calculateTaxAmount = [];
        if (isset($getSessionRequests['address_id'])) {
          $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['address_id']);
        } else {
          $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['billing_address_id']);
        }

        $taxTotalAmount = 0;
        if (count($calculateTaxAmount['tax']) > 0) {
          foreach ($calculateTaxAmount['tax'] as $key => $value) {
            $taxTotalAmount += $value['taxAmount'];
          }
        }

        $grandTotal += $taxTotalAmount;

        $this->placeOrderCommon($getSessionRequests, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT, $getBillingAddress, $getAddress, $shippingMethod, $paymentDetails['data']['id'], $calculateTaxAmount['tax']);
        return redirect('/payment-success');
      } else {
        return redirect()
          ->route('checkout')
          ->with('commonError', 'Payment failed!');
      }
    } else {
      return redirect()
        ->route('checkout')
        ->with('commonError', 'Payment failed!');
    }
  }

  //instamojo success
  public function instamojoSuccess(Request $request)
  {
    try {

      $findPaymentMethod = PaymentMethods::where('payment_code', 'instamojo')->first();

      $api = new \Instamojo\Instamojo(
        $findPaymentMethod->payment_key,
        $findPaymentMethod->payment_secret,
        $findPaymentMethod->payment_url
      );

      $response = $api->paymentRequestStatus(request('payment_request_id'));

      if (!isset($response['payments'][0]['status'])) {
        return redirect()
          ->route('checkout')
          ->with('commonError', 'Payment failed!');
      } else if ($response['payments'][0]['status'] != 'Credit') {
        return redirect()
          ->route('checkout')
          ->with('commonError', 'Payment failed!');
      }
    } catch (\Exception $e) {
      return redirect()
        ->route('checkout')
        ->with('commonError', 'Payment failed!');
    }

    /****************************************************
            complete order after payment success
    ******************************************************/
    $getSessionRequests = session()->get('ORDER_DATA');
    $shippingMethod = session()->get('SHIPPING_DATA');
    $paymentMethod = 'Instamojo Payment Geteway';
    $sessionCartData = session()->get('cart' . session()->getId());

    $getMaxNumber = Order::max('id');
    $getAddress = DB::table('customer_address')->whereId(isset($getSessionRequests['address_id']) ? $getSessionRequests['address_id'] : $getSessionRequests['billing_address_id'])->first();
    $getBillingAddress = DB::table('customer_address')->whereId($getSessionRequests['billing_address_id'])->first();
    $oaymentMethod = '';
    $grandTotal = $sessionCartData['grandTotal'];

    //check coupon
    $counponHistory = DB::table('coupon_history')->where('is_valid', 1)->where('session_id', session()->getId())
      ->where('order_done', 0)->first();
    $discountAMT = 0;
    if ($counponHistory) {
      if ($counponHistory->coupon_type == 1) {
        $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);

        $discountAMT = $subTotal / 100 * $counponHistory->amount;
        $grandTotal -= $discountAMT;
      } else {
        $discountAMT = $counponHistory->amount;
        $grandTotal -= $discountAMT;
      }
    }


    $paymentDone = 0;
    if (!empty($charge) && $charge['status'] == 'succeeded') {
      $paymentDone = 1;
    } else {
      $paymentDone = 0;
    }

    //add tax to grandTotal
    $calculateTaxAmount = [];
    if (isset($getSessionRequests['address_id'])) {
      $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['address_id']);
    } else {
      $calculateTaxAmount = $this->calculateZoneTax($getSessionRequests['billing_address_id']);
    }

    $taxTotalAmount = 0;
    if (count($calculateTaxAmount['tax']) > 0) {
      foreach ($calculateTaxAmount['tax'] as $key => $value) {
        $taxTotalAmount += $value['taxAmount'];
      }
    }

    $grandTotal += $taxTotalAmount;

    $this->placeOrderCommon($getSessionRequests, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT, $getBillingAddress, $getAddress, $shippingMethod, $response['payments'][0]['payment_id'], $calculateTaxAmount['tax']);
    return redirect('/payment-success');
  }

  //mollie payment geteway
  public function mollieTransaction(Request $request)
  {
    $paymentId = $request->input('id');
    $findPaymentMethod = PaymentMethods::where('payment_code', 'mollie')->first();
    Mollie::api()->setApiKey($findPaymentMethod->payment_key);
    $payment = Mollie::api()->payments->get($paymentId);
    $checkExist = null;
    $getTrx = session()->get('TRX_ID');
    if ($getTrx) {
      $checkExist = DB::table("molie_payment_tracking")->where('trx_id', $getTrx)->first();
    }
    $paymentStatus = 0;

    if ($payment->isPaid()) {
      $paymentStatus = 1;
    }

    if ($checkExist != null) {
      DB::table("molie_payment_tracking")
        ->where('trx_id', $getTrx)
        ->update([
          'payment_id' => $paymentId,
          'trx_id' => $payment->metadata->order_id,
          'payment_status' => $paymentStatus
        ]);
    } else {
      DB::table("molie_payment_tracking")->insert([
        'payment_id' => $paymentId,
        'trx_id' => $payment->metadata->order_id,
        'payment_status' => $paymentStatus
      ]);
    }

  }

  //paypal failed function
  public function paypalFailed()
  {
    return redirect()->back()->with('commonError', 'Error when order try again later!');
  }

  //payment success page
  public function paymentSuccess()
  {
    $this->buildSeo('Payment success', ['otrixcommerce', 'Payment success'], url()->current(), '');
    return view('frontend.cart.paymentSuccess');
  }

  //create stripe charges
  private function createCharge($tokenId, $grandTotal, $getAddress)
  {
    $charge = null;
    try {
      $findPaymentMethod = PaymentMethods::where('payment_code', 'stripe')->first();
      $this->stripe = new StripeClient($findPaymentMethod->payment_secret);

      $charge = $this->stripe->charges->create([
        "amount" => $grandTotal * 100,
        "currency" => "usd",
        'source' => $tokenId,
        "description" => config('settingConfig.config_store_name') . " Product Purchase Payment",
        "shipping" => [
          "name" => $getAddress->name,
          "address" => [
            "line1" => $getAddress->address_1,
            "postal_code" => $getAddress->postcode,
            "city" => $getAddress->city,
            "country" => $getAddress->country_id,
          ],
        ]
      ]);
    } catch (Exception $e) {
      $charge['error'] = $e->getMessage();
    }
    return $charge;
  }

  //place order common
  public function placeOrderCommon($request, $sessionCartData, $grandTotal, $paymentMethod, $getMaxNumber, $discountAMT = 0, $getBillingAddress, $getAddress, $findShipping, $trxID = 0, $taxArray = [])
  {

    //build order array
    $orderArr = [
      'invoice_no' => $getMaxNumber,
      'customer_id' => $this->getUser ? $this->getUser->id : 0,
      'firstname' => $this->getUser ? $this->getUser->firstname : $getBillingAddress->name,
      'lastname' => $this->getUser ? $this->getUser->lastname : 'guest',
      'email' => $this->getUser ? $this->getUser->email : $getBillingAddress->email,
      'telephone' => $this->getUser ? $this->getUser->telephone : $getBillingAddress->mobile,
      'order_date' => date('Y-m-d'),
      'shipping_name' => $request['delivery_same_billing'] ? $getBillingAddress->name : $sessionCartData['shipping']['name'],
      'shipping_address_1' => $request['delivery_same_billing'] ? $getBillingAddress->address_1 : $getAddress->address_1,
      'shipping_address_2' => $request['delivery_same_billing'] ? $getBillingAddress->address_2 : $getAddress->address_2,
      'shipping_city' => $request['delivery_same_billing'] ? $getBillingAddress->city : $getAddress->city,
      'shipping_postcode' => $request['delivery_same_billing'] ? $getBillingAddress->postcode : $getAddress->postcode,
      'shipping_country_id' => $request['delivery_same_billing'] ? $getBillingAddress->country_id : $getAddress->country_id,
      'billing_name' => $getBillingAddress->name,
      'billing_address_1' => $getBillingAddress->address_1,
      'billing_address_2' => $getBillingAddress->address_2,
      'billing_city' => $getBillingAddress->city,
      'billing_postcode' => $getBillingAddress->postcode,
      'billing_country_id' => $getBillingAddress->country_id,
      'comment' => $request['comment'],
      'total' => str_replace(",", "", $sessionCartData['subTotal']),
      'order_status_id' => '1',
      //'tax_amount' => array_key_exists('taxes',$sessionCartData) ?  $sessionCartData['taxes']  ? count($sessionCartData['taxes'] ) > 0 ? $sessionCartData['taxes']['taxAmount'] : 0 : 0 : 0,
      'discount' => $discountAMT,
      'shipping_charge' => $sessionCartData['shipping']['charges'],
      'grand_total' => $grandTotal,
      'payment_method' => $paymentMethod,
      'transaction_id' => $request['tid'] ? $request['tid'] : $trxID,
      'shipping_method' => $findShipping
    ];

    //create order  
    $storeOrder = Order::create($orderArr);

    if ($storeOrder) {
      //Store OrderProduct
      $storeOrderProductArr = [];

      foreach ($sessionCartData['cartData'] as $key => $value) {
        $storeOrderProductArr[] = [
          'order_id' => $storeOrder->id,
          'product_id' => $value['pid'],
          'name' => isset($value['name']) ? $value['name'] : 'N/A',
          'quantity' => $value['quantity'],
          'image' => $value['image'],
          'price' => str_replace(",", "", $value['price']),
          'special' => str_replace(",", "", $value['special']),
          'total' => str_replace(",", "", $value['totalPrice']),
          'options' => isset($value['options']) ? serialize($value['options']) : null
        ];
      }

      OrderProduct::insert($storeOrderProductArr);

      //insert order tax
      if (count($taxArray) > 0) {
        $insertTaxArr = [];
        foreach ($taxArray as $t => $tax) {
          $insertTaxArr[] = [
            'order_id' => $storeOrder->id,
            'tax_rate_id' => $tax['tax_rate_id'],
            'tax_name' => $tax['taxName'],
            'tax_amount' => $tax['taxAmount']
          ];
        }
        OrderTax::insert($insertTaxArr);
      }

      //add order history
      OrderHistory::create([
        'order_id' => $storeOrder->id,
        'order_status_id' => '1',
        'notif' => 0,
        'comment' => 'Initial Order'
      ]);


      session()->forget('cart' . session()->getId());

      DB::table('cart')->where('session_id', session()->getId())->delete();
      DB::table('customer_address')->where('session_id', session()->getId())->delete();
      //update coupon
      $counponHistory = DB::table('coupon_history')->where('session_id', session()->getId())->update(['order_done' => 1]);

      //send notification to Admin
      try {
        $customerName = $this->getUser ? $this->getUser->firstname : $getBillingAddress->name;

        $notiData = [
          'title' => 'New Order',
          'body' => 'New Order by customer name ' . $customerName,
          'url' => url('admin/order/view?id=' . $storeOrder->id),
        ];

        $users = User::all();
        Notification::send($users, new PanelNotification($notiData));
      } catch (\Exception $e) {

      }

      /*************************************************************
          sms configuration
      ******************************************************************/
      try {
        $getAlertSMS = config('settingConfig.config_alert_sms');
        if (isset($this->getUser) && strpos($getAlertSMS, 'Orders') !== false) {
          $userMobile = $this->getUser->telephone;
          $receiverNumber = $this->getUser->country_code . '' . $userMobile;
          $message = 'Your order successfully placed order id #' . $storeOrder->id . ' Thank you for shopping.';
          $this->sendSMS($receiverNumber, $message);
        }
      } catch (\Exception $e) {

      }

      /*************************************************************
                 email configuration uncomment this code after setting up mail port ,username and password in .env file
      *********************************/
      try {
        $getAlertEmails = config('settingConfig.config_alert_mail');
        if (strpos($getAlertEmails, 'Orders') !== false) {
          $email = $this->getUser->email;
          $name = $this->getUser->firstname;
          Mail::send('admin.emails.order', ['orderData' => $orderArr, 'orderProducts' => $storeOrderProductArr, 'taxArray' => $taxArray], function ($m) use ($email, $name, $request) {
            $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
            $m->to($email, $name)->subject('Order Confirmation ');
          });
        }
      } catch (\Exception $e) {
      }

    } else {
      return redirect()->back()->with('commonError', 'Error when order try again later!');
    }
  }

  //merge taxes
  public function mergeTax($taxRates)
  {

    $finalTaxRates = [];

    //merge same taxes
    $newTaxArr = [];
    foreach ($taxRates as $key => $value) {
      $newTaxArr[$value['name']][] = $value['taxAmount'];
    }

    //final tax arr
    foreach ($newTaxArr as $key => $value) {
      $finalTaxRates[] = array('name' => $key, 'taxAmount' => array_sum($value));
    }

    return $finalTaxRates;

  }

  //paypal config
  public function paypalConfig()
  {
    $findPaymentMethod = PaymentMethods::where('payment_code', 'paypal')->first();
    return [
      'mode' => env('PAYPAL_MODE', $findPaymentMethod->payment_mode),
      // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
      'sandbox' => [
        'client_id' => $findPaymentMethod->payment_key,
        'client_secret' => $findPaymentMethod->payment_secret,
        'app_id' => 'APP-80W284485P519543T',
      ],
      'live' => [
        'client_id' => $findPaymentMethod->payment_key,
        'client_secret' => $findPaymentMethod->payment_secret,
        'app_id' => env('PAYPAL_LIVE_APP_ID', ''),
      ],

      'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
      // Can only be 'Sale', 'Authorization' or 'Order'
      'currency' => env('PAYPAL_CURRENCY', 'USD'),
      'notify_url' => env('PAYPAL_NOTIFY_URL', ''),
      // Change this accordingly for your application.
      'locale' => env('PAYPAL_LOCALE', 'en_US'),
      // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
      'validate_ssl' => env('PAYPAL_VALIDATE_SSL', false), // Validate SSL when creating api client.
    ];

  }

  public function getPayStackConfig()
  {
    $findPaymentMethod = PaymentMethods::where('payment_code', 'paystack')->first();
    return [
      /**
       * Public Key From Paystack Dashboard
       *
       */
      'publicKey' => $findPaymentMethod->payment_key,

      /**
       * Secret Key From Paystack Dashboard
       *
       */
      'secretKey' => $findPaymentMethod->payment_secret,

      /**
       * Paystack Payment URL
       *
       */
      'paymentUrl' => 'https://api.paystack.co',

      /**
       * Optional email address of the merchant
       *
       */
      'merchantEmail' => $findPaymentMethod->merchant_email,
    ];
  }

  //get cart
  public function getCartData()
  {
    // get cart products
    $getCart = DB::table('cart')->where('session_id', session()->getId())->get();

    $cartData = [];
    $cartTotal = 0.00;
    $subTotal = [];
    $taxRates = [];
    $grandTotal = 0.00;
    $discount = null;
    $taxAMT = 0.00;
    $basePrice = 0.00;
    $optionSum = 0;
    $productOpt = [];
    $discountPer = 0.00;
    $getProducts = [];
    $counponHistory = [];
    $discountAMT = 0;

    if (count($getCart) > 0) {
      $getProducts = Product::select(
        'product.price',
        'product.id',
        'product.model',
        'product.image',
        'product.tax_rate_id as tax_class_id',
        'cart.quantity',
        'cart.cart_id',
        'cart.base_price',
        'tax_rate.rate',
        'tax_rate.type',
        'tax_rate.name as taxName',
        'tax_rate.status as taxStatus',
        'cart.option'
      )
        ->with('productDescription:name,id,product_id')
        ->join('cart', 'cart.product_id', '=', 'product.id')
        ->leftjoin('tax_rate', 'tax_rate.id', '=', 'product.tax_rate_id')
        ->orderBy('cart.date_added', 'DESC')
        ->where('cart.session_id', session()->getId())
        ->get();

      //build cart with with sub total and total
      foreach ($getProducts as $key => $value) {

        $finalPrice = $value->base_price;
        $basePrice = $value->price;
        $specialPrice = 0;
        $optionSum = 0;
        $productOpt = null;
        //check options
        $option_ID = [];
        $decodeOptions = json_decode($value->option);

        if ($decodeOptions != null) {
          foreach ($decodeOptions as $key => $optionValue) {
            $option_ID[] = $optionValue;
          }

          //get Optoins Price
          $productOpt = StoreProductOption::whereIn('product_option_id', $option_ID)
            ->select('store_product_option.label', 'store_product_option.price', 'product_option_description.name')
            ->join('product_options', 'product_options.id', '=', 'store_product_option.option_id')
            ->join('product_option_description', 'product_option_description.option_id', '=', 'product_options.id')
            ->where('product_option_description.language_id', '=', session()->get('currentLanguage'))
            ->get()
            ->toArray();

          $optionSum = StoreProductOption::whereIn('product_option_id', $option_ID)->sum('price');
          if ($optionSum > 0) {
            $finalPrice += (float) $optionSum;
          }
        }

        $cartTotal += (float) $finalPrice * $value->quantity;
        $grandTotal += (float) $finalPrice * $value->quantity;
        $finalPrice = $value->quantity * (float) $finalPrice;

        $cartData[] = [
          'cart_id' => $value->cart_id,
          'name' => $value->productDescription?->name,
          'price' => number_format($value->base_price, 2),
          'quantity' => $value->quantity,
          'image' => $value->image,
          'pid' => $value->id,
          'totalPrice' => $finalPrice,
          'special' => number_format($specialPrice, 2),
          'taxStatus' => $value->taxStatus,
          'taxType' => $value->type,
          'rate' => $value->rate,
          'tax_class_id' => $value->tax_class_id,
          'taxName' => $value->taxName,
          'model' => $value->model,
          'options' => $productOpt
        ];


      }
      //$grandTotal +=  $taxAMT;

      $subTotal[] = ['subTotal' => $cartTotal];

      //store cart in session
      session()->put('cart' . session()->getId(), ['cartData' => $cartData, 'subTotal' => number_format($cartTotal, 2), 'discount' => $discount, 'taxes' => $taxRates, 'grandTotal' => $grandTotal, 'products' => $getProducts]);
      session()->save();
      $counponHistory = DB::table('coupon_history')
        ->where('is_valid', 1)
        ->where('session_id', session()->getId())
        ->where('order_done', 0)->first();

      if ($counponHistory) {

        if ($counponHistory->coupon_type == 1) {
          $subTotal = preg_replace('/[ ,]+/', '', $cartTotal);

          $discountAMT = $subTotal / 100 * $counponHistory->amount;
          $grandTotal -= $discountAMT;
        } else {
          $discountAMT = $counponHistory->amount;
          $grandTotal -= $discountAMT;
        }
      }

      $grandTotal = number_format($grandTotal, 2);
      //store cart in session
      return ['status' => 1, 'cartData' => $cartData, 'subTotal' => number_format($cartTotal, 2), 'discount' => $discount, 'taxes' => $taxRates, 'grandTotal' => $grandTotal, 'products' => $getProducts, 'discountPer' => $discountPer, 'couponData' => $counponHistory, 'discountAMT' => $discountAMT];
    } else {
      return ['status' => 0, 'cartData' => $cartData, 'subTotal' => number_format($cartTotal, 2), 'discount' => $discount, 'taxes' => $taxRates, 'grandTotal' => $grandTotal, 'products' => $getProducts, 'discountPer' => $discountPer, 'couponData' => $counponHistory, 'discountAMT' => $discountAMT];
    }
  }

  //calculate Taxes
  public function calculateTax(Request $request)
  {
    return $this->calculateZoneTax($request->address_id);
  }


}