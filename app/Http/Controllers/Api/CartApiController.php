<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderHistory;
use App\Models\OrderTax;
use App\Models\Shipping;
use App\Models\StoreProductOption;
use Validator;
use File;
use Notification;
use DB;
use Auth;
use Mail;
use Carbon\Carbon;
use PDF;
use App\Notification\PanelNotification;

class CartApiController extends Controller
{
    private $getUser;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->getUser = Auth::guard('api')->user();
            return $next($request);
        });
    }

    //addToCart api
    public function addToCart(Request $request)
    {
        try {
            $getProduct = Product::findOrFail($request->product_id);

            //check product exists or not
            if ($getProduct) {

                //check this product already in cart

                //get getCustomerCart
                $getCustomerCart = DB::table('cart')->where('customer_id', $this->getUser->id)->where('product_id', $request->product_id)->first();

                //if already product in cart then update
                if ($getCustomerCart) {

                    $qty = $getProduct->quantity + $getCustomerCart->quantity;

                    // check stock
                    if ($qty >= $request->quantity) {

                        //update
                        DB::table('cart')->where('cart_id', $getCustomerCart->cart_id)
                            ->update(['quantity' => $getCustomerCart->quantity + $request->quantity, 'option' => $request->options]);

                        //increment product quantity
                        Product::where('id', $getCustomerCart->product_id)->update(['quantity' => $qty]);

                        //decrement product quantity
                        $minusQty = $getCustomerCart->quantity + $request->quantity;
                        Product::where('id', $request->product_id)
                            ->update(['quantity' => $qty - $minusQty]);

                        $cartCount = DB::table('cart')->where('customer_id', $this->getUser->id)->sum('quantity');

                        return ['status' => 1, 'message' => 'Product Added To Cart!', 'cartCount' => $cartCount];

                    } else {
                        return ['status' => 0, 'message' => 'Only ' . $getProduct->quantity . ' products in stock'];
                    }

                }

                //insert product to cart
                else {

                    // check stock
                    if ($getProduct->quantity >= $request->quantity) {

                        DB::table('cart')->insert([
                            'product_id' => $request->product_id,
                            'customer_id' => $this->getUser->id,
                            'quantity' => $request->quantity,
                            'date_added' => date('Y-m-d H:i:s'),
                            'option' => $request->options
                        ]);

                        //decrement product quantity
                        Product::where('id', $request->product_id)->update(['quantity' => $getProduct->quantity - $request->quantity]);

                        $cartCount = DB::table('cart')->where('customer_id', $this->getUser->id)->sum('quantity');

                        return ['status' => 1, 'message' => 'Product Added To Cart!', 'cartCount' => $cartCount];
                    } else {
                        return ['status' => 0, 'message' => 'Only ' . $getProduct->quantity . ' products in stock'];
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
            // get cart products
            $cartCount = DB::table('cart')->where('customer_id', $this->getUser->id)->sum('quantity');
            $cartRecord = $this->getCartData();

            return [
                'status' => 1,
                'message' => 'Cart Data',
                'cartData' => $cartRecord['cartData'],
                'cartCount' => $cartCount,
                'subTotal' => $cartRecord['subTotal'],
                'discount' => $cartRecord['discount'],
                'grandTotal' => $cartRecord['grandTotal'],
                'taxes' => $cartRecord['taxes']
            ];

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
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
                    $cartCount = DB::table('cart')->where('customer_id', $this->getUser->id)->sum('quantity');
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

            //build cart
            $rmsg = 'Cart successfully updated!';
            $cartCount = DB::table('cart')->where('customer_id', $this->getUser->id)->sum('quantity');
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

            $sessionCartData = $this->getCartData();
            if (count($sessionCartData) > 0) {
                //find coupon
                $counponHistory = DB::table('coupon_history')->where('customer_id', $this->getUser->id)->where('order_done', 0)->first();
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
                        DB::table('coupon_history')->where('order_done', 0)->where('customer_id', $this->getUser->id)->update([
                            'coupon_id' => $getCoupon->id,
                            'coupon_type' => $getCoupon->type,
                            'amount' => $getCoupon->type == 1 ? $getCoupon->discount : $discountAmt,
                            'date_added' => date('Y-m-d'),
                            'is_valid' => true,
                            'coupon_code' => $getCoupon->code
                        ]);
                    } else {
                        //insert
                        DB::table('coupon_history')->insert(['coupon_id' => $getCoupon->id, 'coupon_type' => $getCoupon->type, 'customer_id' => $this->getUser ? $this->getUser->id : 0, 'amount' => $getCoupon->type == 1 ? $getCoupon->discount : $discountAmt, 'date_added' => date('Y-m-d'), 'is_valid' => true, 'coupon_code' => $getCoupon->code]);
                    }

                    return ['status' => 1, 'message' => "Coupon successfully applied!", 'discount' => $discount, 'discountType' => $getCoupon->type, 'discountPer' => number_format($getCoupon->discount, 2), 'grandTotal' => number_format($grandTotal, 2)];
                } else {
                    if ($counponHistory) {
                        // if($counponHistory->is_valid){
                        //   $grandTotal += $counponHistory->amount;
                        // }
                        DB::table('coupon_history')->where('order_done', 0)->where('customer_id', $this->getUser->id)->update(['is_valid' => false]);
                    }
                    return ['status' => 0, 'message' => 'Coupon expired/Invalid!', 'grandTotal' => number_format($grandTotal, 2)];
                }
            } else {
                return ['status' => 0, 'message' => 'Invalid coupon code'];
            }

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }

    }

    public function getCheckoutData()
    {
        try {
            $data = [];
            $data['shippingMethods'] = Shipping::where('status', 1)->get();
            $data['addresses'] = DB::table('customer_address')->join('country', 'country.id', '=', 'customer_address.country_id')->select('customer_address.*', 'country.name as country')->where('customer_id', $this->getUser->id)->get();
            $data['countries'] = Country::where('status', '1')->select('id', 'name', 'iso_code_3', 'postcode_required', 'status')->with('states')->orderBy('name', 'ASC')->get();
            return ['status' => 1, 'data' => $data];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    public function selectShipping($id)
    {

        try {
            $findShipping = Shipping::findOrFail($id);

            //get cart data
            $sessionCartData = $this->getCartData();

            if ($sessionCartData) {

                $shipping = [
                    'name' => $findShipping->name,
                    'charges' => $findShipping->shipping_charge,
                    'id' => $findShipping->id
                ];

                $grandTotal = preg_replace('/[ ,]+/', '', $sessionCartData['grandTotal']);

                $grandTotal = $grandTotal + $findShipping->shipping_charge;

                session()->put('shipping_session' . $this->getUser->id, $shipping);
                session()->save();

                return ['status' => 1, 'shipping' => $shipping, 'discountAMT' => $sessionCartData['discount'], 'orderSummary' => $sessionCartData['cartData'], 'subTotal' => $sessionCartData['subTotal'], 'grandTotal' => number_format($grandTotal, 2)];
            } else {
                return ['status' => 1, 'message' => 'Session expired add products again!'];
            }
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    public function placeOrder(Request $request)
    {
        try {
            $sessionCartData = $this->getCartData();
            $getMaxNumber = Order::max('id');
            $getAddress = DB::table('customer_address')->whereId($request->address_id)->first();
            $shippingData = session()->get('shipping_session' . $this->getUser->id);

            $paymentMethod = '';
            if ($request->payment_method == 'creditCard') {
                $paymentMethod = 'Credit/Debit Card';
            } else if ($request->payment_method == 'cod') {
                $paymentMethod = 'Cash On Delivery';
            }

            $grandTotal = preg_replace('/[ ,]+/', '', $sessionCartData['grandTotal']);

            //add tax to grandTotal
            $calculateTaxAmount = [];
            $calculateTaxAmount = $this->calculateZoneTax($request->address_id, $this->getUser->id);

            $taxTotalAmount = 0;
            if (count($calculateTaxAmount['tax']) > 0) {
                foreach ($calculateTaxAmount['tax'] as $key => $value) {
                    $taxTotalAmount += $value['taxAmount'];
                }
            }

            $grandTotal += $taxTotalAmount;
            $grandTotal += $shippingData['charges'];

            //build order array
            $orderArr = [
                'invoice_no' => $getMaxNumber,
                'customer_id' => $this->getUser->id,
                'firstname' => $this->getUser->firstname,
                'lastname' => $this->getUser->lastname,
                'email' => $this->getUser->email,
                'telephone' => $this->getUser->telephone,
                'order_date' => date('Y-m-d'),
                'shipping_name' => $shippingData['name'],
                'shipping_address_1' => $getAddress->address_1,
                'shipping_address_2' => $getAddress->address_2,
                'shipping_city' => $getAddress->city,
                'shipping_postcode' => $getAddress->postcode,
                'shipping_country_id' => $getAddress->country_id,
                'comment' => $request->comment,
                'total' => str_replace(",", "", $sessionCartData['subTotal']),
                'order_status_id' => '1',
                'tax_amount' => array_key_exists('taxes', $sessionCartData) ? $sessionCartData['taxes'] ? count($sessionCartData['taxes']) > 0 ? $sessionCartData['taxes']['taxAmount'] : 0 : 0 : 0,
                'discount' => array_key_exists('discount', $sessionCartData) ? $sessionCartData['discount'] ? count($sessionCartData['discount']) > 0 ? $sessionCartData['discount']['discountAmt'] : 0 : 0 : 0,
                'shipping_charge' => $shippingData['charges'],
                'grand_total' => $grandTotal,
                'payment_method' => $paymentMethod,
                'transaction_id' => $request->transaction_id
            ];

            //create order
            $storeOrder = Order::create($orderArr);
            if ($storeOrder) {

                //Store OrderProduct
                $storeOrderProductArr = [];
                foreach ($sessionCartData['cartData'] as $key => $value) {
                    $storeOrderProductArr[] = [
                        'order_id' => $storeOrder->id,
                        'product_id' => $value['id'],
                        'name' => $value['name'],
                        'quantity' => $value['quantity'],
                        'image' => $value['image'],
                        'price' => str_replace(",", "", $value['price']),
                        'special' => str_replace(",", "", $value['special']),
                        'total' => str_replace(",", "", $value['totalPrice'])
                    ];
                }

                OrderProduct::insert($storeOrderProductArr);

                //add order history
                OrderHistory::create([
                    'order_id' => $storeOrder->id,
                    'order_status_id' => '1',
                    'notif' => 0,
                    'comment' => 'Initial Order'
                ]);

                if (count($calculateTaxAmount['tax']) > 0) {
                    $insertTaxArr = [];
                    foreach ($calculateTaxAmount['tax'] as $t => $tax) {
                        $insertTaxArr[] = [
                            'order_id' => $storeOrder->id,
                            'tax_rate_id' => $tax['tax_rate_id'],
                            'tax_name' => $tax['taxName'],
                            'tax_amount' => $tax['taxAmount']
                        ];
                    }
                    OrderTax::insert($insertTaxArr);
                }

                //send mail
                $getAlertEmails = config('settingConfig.config_alert_mail');

                if (strpos($getAlertEmails, 'Orders') !== false) {
                    $email = $this->getUser->email;
                    $name = $this->getUser->firstname;

                    /*************************************************************
                          email configuration uncomment this code after setting up mail port ,username and password in .env file
               *********************************/

                    // Mail::send('admin.emails.order', ['orderData' => $orderArr,'orderProducts' => $storeOrderProductArr], function ($m) use($email,$name,$request) {
                    //     $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
                    //     $m->to($email, $name)->subject('Order Confirmation ');
                    //   });
                }



                //send notification to Admin
                try {
                    $customerName = $this->getUser->firstname;

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
                        Mail::send('admin.emails.order', ['orderData' => $orderArr, 'orderProducts' => $storeOrderProductArr, 'taxArray' => $calculateTaxAmount['tax']], function ($m) use ($email, $name, $request) {
                            $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
                            $m->to($email, $name)->subject('Order Confirmation ');
                        });
                    }
                } catch (\Exception $e) {
                }

                //update coupon
                DB::table('coupon_history')->where('customer_id', $this->getUser->id)->update(['order_done' => 1]);
                DB::table('cart')->where('customer_id', $this->getUser->id)->delete();

                return ['status' => 1, 'message' => 'Order successfully placed!', 'orderID' => $storeOrder->id];
            } else {
                return ['status' => 0, 'message' => 'Error when order try again later!'];
            }
            //
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }

    }

    //get order list
    public function getOrdersList()
    {
        try {
            $getOrders = Order::with('orderStatus:name,id', 'products:name,quantity,image,order_id,product_id,total')
                ->where('customer_id', $this->getUser->id)
                ->orderBy('order.order_date', 'DESC')->paginate($this->defaultPaginate);
            return ['status' => 1, 'data' => $getOrders];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //get order timeline
    public function getOrderTimeline($orderID)
    {
        try {
            $getTimeline = OrderHistory::with('orderStatus:id,name,status')->where('order_id', $orderID)->get();
            $timelineArr = [];
            foreach ($getTimeline as $key => $value) {
                $timelineArr[] = [
                    'time' => date('H:i', strtotime($value->created_at)),
                    'title' => $value->orderStatus->name,
                    'description' => $value->comment,
                ];
            }

            $taxes = OrderTax::where('order_id', $orderID)->get();


            return ['status' => 1, 'data' => $timelineArr, 'taxes' => $taxes];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //cancel orders
    public function cancelOrder(Request $request)
    {
        $update = Order::where('id', $id)->update(['order_status_id' => "7"]);
        DB::table('cancel_order')->insert([
            'order_id' => $id,
            'reason' => $request->reason
        ]);
        return ['status' => 1, 'message' => 'Order successfully canceled!'];
    }

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

    //get cart
    public function getCartData()
    {
        $getCart = DB::table('cart')->where('customer_id', $this->getUser->id)->get();
        $cartData = [];
        $cartTotal = 0.00;
        $subTotal = [];
        $taxRates = [];
        $grandTotal = 0.00;
        $discount = null;
        $taxAMT = 0.00;
        $basePrice = 0.00;
        $optionSum = 0;
        $discountPer = 0;
        $getProducts = null;
        if (count($getCart) > 0) {
            $getProducts = Product::select(
                'product.price',
                'product.id',
                'product.model',
                'product.image',
                'product.tax_rate_id',
                'cart.quantity',
                'cart.cart_id',
                'product_description.name',
                'tax_rate.rate',
                'tax_rate.type',
                'tax_rate.name as taxName',
                'tax_rate.status as taxStatus',
                'product_special.price as specialPrice',
                'product_special.start_date',
                'product_special.end_date',
                'cart.option'
            )
                ->join('cart', 'cart.product_id', '=', 'product.id')
                ->join('product_description', 'product_description.product_id', '=', 'product.id')
                ->leftjoin('tax_rate', 'tax_rate.id', '=', 'product.tax_rate_id')
                ->leftjoin('product_special', 'product_special.product_id', '=', 'product.id')
                ->orderBy('cart.date_added', 'DESC')
                ->where('cart.customer_id', $this->getUser->id)
                ->where('product_description.language_id', session()->get('currentLanguage'))
                ->get();


            //build cart with with sub total and total
            foreach ($getProducts as $key => $value) {

                $finalPrice = $value->price;
                $basePrice = $value->price;
                $specialPrice = 0;
                $optionSum = 0;

                if ($value->specialPrice) {
                    if ($value->start_date <= date('Y-m-d') && $value->end_date >= date('Y-m-d')) {
                        $specialPrice = $value->specialPrice;
                        $finalPrice = $value->specialPrice;
                        $basePrice = $value->specialPrice;
                    }
                }

                //check options
                $decodeOptions = json_decode($value->option);
                $optionIDArr = [];
                if ($decodeOptions != null) {

                    foreach ($decodeOptions as $key => $optionValue) {
                        $optionIDArr[] = $optionValue;
                    }

                    //get Optoins Price
                    $optionSum = StoreProductOption::whereIn('product_option_id', $optionIDArr)->sum('price');
                    if ($optionSum > 0) {
                        $finalPrice += (float) $optionSum;
                    }
                }

                $cartTotal += (float) $finalPrice * $value->quantity;
                $grandTotal += (float) $finalPrice * $value->quantity;
                $finalPrice = $value->quantity * (float) $finalPrice;
                $cartData[] = [
                    'cart_id' => $value->cart_id,
                    'name' => $value->name,
                    'price' => $optionSum > 0 ? number_format($basePrice + $optionSum, 2) : number_format($value->price, 2),
                    'quantity' => $value->quantity,
                    'image' => $value->image,
                    'id' => $value->id,
                    'totalPrice' => $finalPrice,
                    'special' => number_format($specialPrice, 2),
                    'taxStatus' => $value->taxStatus,
                    'taxType' => $value->type,
                    'rate' => $value->rate,
                    'taxName' => $value->taxName,
                    'tax_class_id' => $value->tax_rate_id
                ];


            }

            $subTotal[] = ['subTotal' => $cartTotal];
            $taxRates = ['name' => 'Taxes', 'taxAmount' => $taxAMT];

            $grandTotal += $taxAMT;

            //Again calculate discount
            $findDiscount = DB::table('coupon_history')->where('customer_id', $this->getUser->id)->where('is_valid', 1)->where('order_done', 0)->first();

            if ($findDiscount) {
                $discountType = $findDiscount->coupon_type;

                //calculate discount
                if ($findDiscount->coupon_type == 1) {
                    $discountPer = number_format($findDiscount->amount, 2);
                    $discountAMT = $cartTotal / 100 * $findDiscount->amount;
                    $grandTotal -= $discountAMT;
                } else {
                    $discountAMT = $findDiscount->amount;
                    $grandTotal -= $discountAMT;
                }

                $discount = [
                    'name' => $findDiscount->coupon_code,
                    'discountAmt' => number_format($discountAMT, 2),
                    'type' => $findDiscount->coupon_type,
                    'discount' => $findDiscount->amount
                ];
            }

            $grandTotal = number_format($grandTotal, 2);
            //store cart in session
            return ['cartData' => $cartData, 'subTotal' => number_format($cartTotal, 2), 'discount' => $discount, 'taxes' => $taxRates, 'grandTotal' => $grandTotal, 'products' => $getProducts, 'discountPer' => $discountPer];
        } else {
            return ['cartData' => $cartData, 'subTotal' => number_format($cartTotal, 2), 'discount' => $discount, 'taxes' => $taxRates, 'grandTotal' => $grandTotal, 'products' => $getProducts, 'discountPer' => $discountPer];
        }
    }

    //calculate tax
    public function calculateTax(Request $request)
    {

        return $this->calculateZoneTax($request->address_id, $this->getUser->id);
    }

}