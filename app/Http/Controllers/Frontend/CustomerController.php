<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\CustomFileTrait;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Language;
use App\Models\Country;
use App\Models\OrderTax;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Validator;
use File;
use DB;
use Auth;
use Hash;
use PDF;
use Carbon\Carbon;

class CustomerController extends Controller
{
  private $getUser;
  use CustomFileTrait;
  protected $path = '';

  public function __construct()
  {
    $this->path = public_path(config('constant.file_path.user'));
    $this->middleware(function ($request, $next) {
      $this->getUser = Auth::guard('customer')->user();
      return $next($request);
    });
  }

  //user dashboard
  public function userDashboard()
  {
    $recentOrders = Order::where('customer_id', $this->getUser->id)->latest()->take(10)->get();
    $this->buildSeo('User Dashboard', ['otrixcommerce', 'User Dashboard'], url()->current(), 'User Dashboard - Account data,Order History');

    return view('frontend.user.dashboard', compact('recentOrders'));
  }

  //get customer details
  public function getCustomerDetails()
  {
    return ['status' => 1, 'data' => $this->getUser];
  }

  //add address
  public function addAddress(Request $request)
  {
    try {
      $validator = Validator::make(
        $request->all(),
        [
          'name' => 'required|regex:/^[\pL\s\-]+$/u',
          'country_id' => 'required|max:10',
          'city' => 'required|max:100',
          'postcode' => 'required|max:10',
          'address_1' => 'required',
        ],
        [
          'name' => 'Name is required',
          'country_id' => 'Country is Required',
          'city' => 'City is Required',
          'postcode' => 'Postcode is Required',
          'address_1' => 'Address 1 is Required'
        ]
      );

      if ($validator->fails()) {
        $message = $this->one_validation_message($validator);
        return ['status' => 0, 'message' => $message];
      }

      $storeData = $request->except(['_token']);
      if ($this->getUser) {
        $storeData['customer_id'] = $this->getUser->id;
      } else {
        $storeData['session_id'] = session()->getId();
        $storeData['email'] = $request->email;
        $storeData['mobile'] = $request->mobile;
      }

      $storeAddress = DB::table('customer_address')->insertGetId($storeData);
      $addresses = DB::table('customer_address')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->select('customer_address.*', 'country.name as country')
        ->where('customer_address.id', $storeAddress)
        ->first();

      $countries = Country::where('status', '1')
        ->select('id', 'name', 'iso_code_3', 'postcode_required', 'status')
        ->orderBy('name', 'ASC')
        ->get()
        ->toArray();

      return ['status' => 1, 'message' => 'Address added successfully!', 'countries' => $countries, 'addresses' => $addresses];
    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }
  }

  //edit address
  public function editAddress(Request $request)
  {

    try {
      $validator = Validator::make(
        $request->all(),
        [
          'name' => 'required|regex:/^[\pL\s\-]+$/u',
          'country_id' => 'required|max:10',
          'state_id' => 'required|max:10',
          'city' => 'required|max:100',
          'postcode' => 'required|max:10',
          'address_1' => 'required|max:128',
        ]
      );

      if ($validator->fails()) {
        $message = $this->one_validation_message($validator);
        return ['status' => 0, 'message' => $message];
      }

      $storeAddress = DB::table('customer_address')->where('id', $request->id)->update($request->except(['_token']));
      $addresses = DB::table('customer_address')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->select('customer_address.*', 'country.name as country');
      if ($this->getUser) {
        $addresses = $addresses->where('customer_address.id', $request->id);
      } else {
        $addresses = $addresses->where('customer_address.session_id', session()->getId());
      }

      $addresses = $addresses->first();

      return ['status' => 1, 'message' => 'Address updated successfully!', 'address' => $addresses];
    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }

  }
  //delete address
  public function deleteAddress(Request $request)
  {
    try {
      DB::table('customer_address')->where('id', $request->id)->delete();
      $addresses = DB::table('customer_address')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->select('customer_address.*', 'country.name as country');
      if ($this->getUser) {
        $addresses = $addresses->where('customer_address.id', $request->id);
      } else {
        $addresses = $addresses->where('customer_address.session_id', session()->getId());
      }

      $addresses = $addresses->get();

      return ['status' => 1, 'message' => 'Address deleted successfully!', 'addresses' => $addresses];
    } catch (\Exception $e) {
      return ['status' => 0, 'message' => 'Error'];
    }
  }
  //update profile
  public function updateProfile(Request $request)
  {

    try {

      $validator = $request->validate([
        'firstName' => 'required|max:255',
        'telephone' => 'required|max:10',
        'email' => 'required',
      ], [
        'firstName' => 'First name is required',
        'telephone' => 'Mobile number is required',
        'email' => 'Email Address is required'
      ]);

      if ($request->hasFile('profile')) {
        $this->createDirectory($this->path);
        $imageName = $this->saveCustomFileAndGetImageName(request()->file('profile'), $this->path);
        Customer::where('id', $this->getUser->id)->update(['image' => $imageName]);
      }

      $update = Customer::where('id', $this->getUser->id)->update($request->except(['_token', 'profile']));
      $getNew = Customer::select('firstname', 'lastname', 'email', 'image', 'creation', 'telephone')->findOrFail($this->getUser->id);
      return redirect()->back()->with('commonSuccess', 'Profile Successfully Updated');
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }
  //add/update to wishlist
  public function addUpdateWishlist(Request $request)
  {
    try {

      $validator = Validator::make(
        $request->all(),
        [
          'product_id' => 'required|max:11',
        ]
      );

      if ($validator->fails()) {
        $message = $this->one_validation_message($validator);
        return ['status' => 0, 'message' => $message];
      }

      $find = DB::table('wishlist')->where('product_id', $request->product_id)->where('customer_id', $this->getUser->id)->first();
      $msg = '';
      $add = 1;
      if ($find) {
        DB::table('wishlist')->whereId($find->id)->delete();
        $msg = 'Product successfully removed from wishlist!';
        $add = 0;
      } else {
        DB::table('wishlist')->insert([
          'customer_id' => $this->getUser->id,
          'product_id' => $request->product_id,
        ]);
        $msg = 'Product successfully added to wishlist!';
        $add = 1;
      }

      $wishlistData = DB::table('wishlist')->where('customer_id', $this->getUser->id)->get();

      return ['status' => 1, 'message' => $msg, 'wishlistData' => $wishlistData, 'add' => $add];

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }
  //wishlist data
  public function getWishlist()
  {
    try {

      $productID = [];
      $productID = DB::table('wishlist')->where('customer_id', $this->getUser->id)->pluck('product_id');

      $wishlistData = Product::select('id', 'image', 'model', 'price', 'quantity', 'sort_order', 'status')
        ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
        ->orderBy('product.sort_order', 'ASC')
        ->whereIn('product.id', $productID)
        ->paginate($this->defaultPaginate);

      $this->buildSeo('User Wishlist', ['otrixcommerce', 'User Wishlist'], url()->current(), 'User Wishlist');

      return view('frontend.user.wishlist', compact('wishlistData'));
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }
  //change password
  public function getChangePassword(Request $request)
  {
    try {
      $this->buildSeo('Change Password', ['otrixcommerce'], url()->current(), '');

      return view('frontend.user.changepassword');
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }
  //do change password
  public function changePassword(Request $request)
  {
    $validator = $request->validate([
      'current_password' => 'required|max:255',
      'new_password' => 'required',
      'confirm_password' => 'required|same:new_password'
    ], [
      'current_password' => 'Old password is required',
      'new_password' => 'New password is required',
      'confirm_password' => 'Cofirm password does not match'
    ]);

    $current_password = $this->getUser->password;
    if (Hash::check($request->current_password, $current_password)) {
      $customer = Customer::find($this->getUser->id);
      $customer->password = Hash::make($request->new_password);
      $customer->save();
      return redirect()->back()->with('commonSuccess', 'Password successfully changed');
    } else {
      return redirect()->back()->with('commonError', 'Current password wrong!');
    }

  }
  //change profile image
  public function changeProfilePicture(Request $request)
  {

    try {
      $validator = Validator::make(
        $request->all(),
        [
          'image' => 'required|image|mimes:jpeg,jpg,png|max:512',
        ]
      );

      if ($validator->fails()) {
        $message = $this->one_validation_message($validator);
        return ['status' => 0, 'message' => $message];
      }

      $this->createDirectory($this->path);
      $imageName = $this->saveCustomFileAndGetImageName(request()->file('image'), $this->path);
      Customer::whereId($this->getUser->id)->update(['image' => $imageName]);
      $getNew = Customer::select('firstname', 'lastname', 'email', 'telephone', 'image', 'creation')->findOrFail($this->getUser->id);
      return ['status' => 1, 'message' => 'Profile image uploaded!', 'data' => $getNew];

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }

  }

  //add review
  public function addReview(Request $request)
  {
    try {


      $validator = $request->validate([
        'rating' => 'required'

      ], [
        'rating' => 'Rating Required',
      ]);



      $find = DB::table('review')->where('customer_id', $this->getUser->id)->where('product_id', $request->product_id)->wherenull('deleted_at')->first();

      if ($find) {
        DB::table('review')
          ->where('customer_id', $this->getUser->id)
          ->where('product_id', $request->product_id)
          ->update([
            'product_id' => $request->product_id,
            'customer_id' => $this->getUser->id,
            'text' => $request->text,
            'rating' => $request->rating,
          ]);
      } else {
        DB::table('review')->insert([
          'product_id' => $request->product_id,
          'customer_id' => $this->getUser->id,
          'author' => 'admin',
          'text' => $request->text,
          'rating' => $request->rating,
          'status' => '1'
        ]);
      }


      return redirect()->back()->with('commonSuccess', 'Review successfully submited!');

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  // get address
  public function getAdress()
  {
    try {
      $address = DB::table('customer_address')
        ->select('customer_address.*', 'country.name as country')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->where('customer_id', $this->getUser->id)
        ->get();

      $countires = Country::where('status', '1')->select('id', 'name', 'iso_code_3', 'postcode_required', 'status')->orderBy('name', 'ASC')->get();
      $this->buildSeo('Manage Address', ['otrixcommerce', 'Manage Address'], url()->current(), '');

      return view('frontend.user.manage-address', compact('address', 'countires'));

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }
  //order list
  public function getOrdersList()
  {
    try {
      $orders = Order::with('orderStatus:name,id', 'products:name,quantity,image,order_id,product_id,total')
        ->select('id', 'invoice_no', 'order_date', 'grand_total', 'order_status_id')
        ->where('customer_id', $this->getUser->id)
        ->orderBy('order.created_at', 'DESC')->paginate($this->defaultPaginate);
      $this->buildSeo('My Orders', ['otrixcommerce', 'My Orders'], url()->current(), '');

      return view('frontend.user.orderlist', compact('orders'));
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  //get specific address
  public function getAddress(Request $request)
  {
    try {
      $address = DB::table('customer_address')
        ->select('customer_address.*', 'country.name as country')
        ->join('country', 'country.id', '=', 'customer_address.country_id')
        ->where('customer_address.id', $request->id)
        ->first();
      return ['status' => 1, 'data' => $address];
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  //getorder details
  public function orderDetails($id, Request $request)
  {

    try {
      $order = Order::with('orderStatus:name,id', 'products:price,name,quantity,image,order_id,product_id,total')
        ->where('order.id', $id)
        ->orderBy('order.order_date', 'DESC')
        ->first();

      $this->buildSeo('Order Details', ['otrixcommerce', 'Order Details'], url()->current(), '');

      //get order tax
      $orderTaxes = OrderTax::where('order_id', $id)->get();

      return view('frontend.user.orderdetails', compact('order', 'orderTaxes'));
    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  public function orderDownloadPDF($id)
  {
    try {
      $order = Order::with('orderStatus:name,id', 'products:name,price,special,quantity,image,order_id,product_id,total', 'orderCountry')
        ->where('order.id', $id)
        ->first();

      //find language
      $orderProducts = OrderProduct::where('order_id', $id)->get();

      $orderProductsArr = [];
      $prodcutIDs = [];
      foreach ($orderProducts as $key => $value) {
        $orderProductsArr[] = [
          'product_id' => $value->product_id,
          'order_id' => $value->order_id,
          'quantity' => $value->quantity,
          'price' => $value->price,
          'special' => $value->special,
          'image' => $value->image,
          'total' => $value->total,
          'options' => $value->options,
          'reward' => $value->reward
        ];

        $prodcutIDs[] = $value->product_id;
      }

      $productData = $productData['product'] = Product::select('id')
        ->with('productDescription:name,id,product_id')
        ->whereIn('id', $prodcutIDs)
        ->get();

      $productLangArr = [];
      foreach ($productData as $key => $proData) {
        $productLangArr[] = ['product_id' => $proData->id, 'name' => $proData->productDescription->name];
      }

      $productDataFinalArr = [];
      foreach ($orderProductsArr as $val) {
        foreach ($productLangArr as $val2) {
          if ($val['product_id'] == $val2['product_id']) {
            $productDataFinalArr[] = [
              'name' => $val2['name'],
              'product_id' => $val['product_id'],
              'order_id' => $val['order_id'],
              'quantity' => $val['quantity'],
              'price' => $val['price'],
              'special' => $val['special'],
              'image' => $val['image'],
              'total' => $val['total'],
              'options' => $val['options'],
              'reward' => $val['reward']
            ];
          }
        }
      }

      $orderProductsArray = array_merge($orderProductsArr, $productLangArr);
      $orderTaxes = OrderTax::where('order_id', $id)->get();
      $getCurrentLanguage = session()->get('currentLanguage');
      $findLanguage = Language::find($getCurrentLanguage);


      $pdf = PDF::loadView('admin.pdf.invoice', ['language_code' => $findLanguage->code, 'orderTaxes' => $orderTaxes, 'orderData' => $order, 'orderProducts' => $productDataFinalArr]);
      return $pdf->download('invoice-' . $order->invoice_prefix . '' . $order->invoice_no . '.pdf');

    } catch (\Exception $e) {
      return redirect()->back()->with('commonError', 'Error');
    }
  }

  public function one_validation_message($validator)
  {
    $validation_messages = $validator->getMessageBag()->toArray();
    $validation_messages1 = array_values($validation_messages);
    $new_validation_messages = [];
    for ($i = 0; $i < count($validation_messages1); $i++) {
      $inside_element = count($validation_messages1[$i]);
      for ($j = 0; $j < $inside_element; $j++) {
        array_push($new_validation_messages, $validation_messages1[$i]);
      }
    }
    return implode(' ', $new_validation_messages[0]);
  }

}