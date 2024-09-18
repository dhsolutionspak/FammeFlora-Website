<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderTax;
use App\Models\OrderHistory;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use PDF;

class OrderController extends Controller
{
  public function index(Request $request)
  {
    $name = $request->get('name', null);
    $filterStatus = null;
    if ($request->filterStatus && $request->filterStatus != 'all') {
      $find = OrderStatus::where('name', 'like', '%' . substr($request->filterStatus, 0, 6) . '%')->first();
      $filterStatus = $find->id;
    }


    $records = Order::select('id', 'firstname', 'lastname', 'payment_method', 'invoice_no', 'invoice_prefix', 'shipping_name', 'order_date', 'order_status_id', 'total', 'grand_total')
      ->withCount('productRelation')
      ->with('orderStatus:name,id');

    if ($name) {
      $records = $records->where('firstname', 'like', "%$name%")->orWhere('email', 'like', "%$name%");
    }

    $records = $records->when($filterStatus != null, function ($q) use ($filterStatus) {
      $q->whereHas('orderStatus', function ($q) use ($filterStatus) {
        $q->where('id', $filterStatus);
      });
    });

    $records = $records->orderBy('created_at', 'DESC')->paginate($this->defaultPaginate);

    $orderStatus = OrderStatus::getActivePluck();

    return view('admin.order.index', ['records' => $records, 'orderStatus' => $orderStatus]);
  }

  public function add()
  {
    $data['customers'] = Customer::getActivePluck();
    $data['products'] = ProductDescription::getActivePluck();
    $data['country'] = Country::getActivePluck();
    $data['order_status'] = OrderStatus::getActivePluck();
    return view('admin.order.add', ['data' => $data]);
  }

  protected function validateData($request)
  {
    $this->validate($request, [
      'firstname' => ['required', 'string', 'max:255']
    ]);
  }

  public function store(Request $request)
  {

    $this->validateData($request);
    //Order Create
    $order = new Order($request->only(Order::$fillableValue));
    $order->invoice_prefix = Order::INVOICE_PREFIX;
    $order->ip = $request->ip();
    $order->save();

    $this->createOrderProduct($order->id); //Order Product Create

    $this->createOrderHistory($order->id); //Order History Create

    return response()->json(
      [
        'code' => 200,
        'msg' => 'Order Created Successfully',
        'route' => route('order')
      ]
      ,
      200
    );
  }

  protected function createOrderHistory($orderId)
  {
    $orderHistory = new OrderHistory(request()->only('order_status_id', 'comment'));
    $orderHistory->order_id = $orderId;
    $orderHistory->save();
  }

  protected function createOrderProduct($orderId)
  {

    $productArray = array_filter(json_decode(request()->productData, true));
    data_set($productArray, '*.order_id', $orderId);
    OrderProduct::insert($productArray);
  }

  public function edit($id)
  {

    $data['customers'] = Customer::getActivePluck();
    $data['products'] = ProductDescription::getActivePluck();
    $data['country'] = Country::getActivePluck();
    $data['order_status'] = OrderStatus::getActivePluck();
    $data['order'] = Order::with('productRelation')->findOrFail($id);
    //        dd($data['order']->toArray());
    return view('admin.order.edit', [
      'data' => $data,
    ]);
  }

  public function view(Request $request)
  {
    $order = Order::with('orderStatus:name,id', 'orderCountry:name', 'products:name,quantity,image,order_id,product_id,total')
      ->where('id', $request->id)
      ->first();
    //get order tax
    $orderTaxes = OrderTax::where('order_id', $request->id)->get();
    $notificationID = $request->get('notificationID', 0);
    if ($notificationID != 0) {
      $notification = auth()->user()->notifications()->find($notificationID);
      if ($notification) {
        $notification->delete();
      }
    }

    $orderProducts = OrderProduct::where('order_id', $request->id)->get();
    $orderStatus = OrderStatus::where('status', '1')->get();
    $orderHistory = OrderHistory::where('order_id', $request->id)->orderBy('created_at', 'Desc')->get();

    return view('admin.order.view', compact('order', 'orderTaxes', 'orderProducts', 'orderStatus', 'orderHistory'));

  }

  public function downloadPDF(Request $request)
  {


    $id = $request->order_id;
    $order = Order::with('orderStatus:name,id', 'products:name,price,special,quantity,image,order_id,product_id,total', 'orderCountry')
      ->where('order.id', $id)
      ->first();

    //find language
    $findLanguage = Language::find($request->pdf_language);
    app()->setLocale($findLanguage->code);
    $getCurrentLanguage = session()->get('currentLanguage');
    session()->put('currentLanguage', $findLanguage->id);

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

    session()->put('currentLanguage', $getCurrentLanguage);

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


    $orderStatus = OrderStatus::where('status', '1')->get();
    $orderTaxes = OrderTax::where('order_id', $id)->get();

    $orderHistory = OrderHistory::where('order_id', $id)->orderBy('created_at', 'Desc')->get();

    $pdf = PDF::loadView('admin.pdf.invoice', ['language_code' => $findLanguage->code, 'orderTaxes' => $orderTaxes, 'orderData' => $order, 'orderProducts' => $productDataFinalArr]);
    app()->setLocale('en');
    return $pdf->download('invoice-' . $order->invoice_prefix . '' . $order->invoice_no . '.pdf');
  }

  public function update(Request $request, $id)
  {

    $order = Order::findOrFail($id);
    $order->invoice_prefix = Order::INVOICE_PREFIX;
    $order->ip = $request->ip();
    $order->fill($request->only(Order::$fillableValue))->save();

    //Order Product Create
    OrderProduct::whereOrderId($order->id)->delete();
    $this->createOrderProduct($order->id);

    $this->createOrderHistory($order->id);

    return response()->json(
      [
        'code' => 200,
        'msg' => 'Order Updated Successfully',
        'route' => route('order')
      ]
      ,
      200
    );
  }

  public function delete($id)
  {
    if (!$data = Order::whereId($id)->first()) {
      return redirect()->back()->with('error', 'Something went wrong');
    }
    OrderProduct::whereOrderId($data->id)->delete();
    OrderHistory::whereOrderId($data->id)->delete();
    OrderTax::where('order_id', $data->id)->delete();
    $data->delete();
    return redirect(route('order'))->with('success', 'Order  Deleted Successfully');
  }

  public function updateStatus($id, Request $request)
  {

    OrderHistory::create([
      'order_id' => $id,
      'order_status_id' => $request->order_status_id,
      'comment' => $request->comment
    ]);

    $getOrder = Order::where('id', $id)->first();

    Order::where('id', $id)->update([
      'order_status_id' => $request->order_status_id
    ]);

    $getOrderStatusName = DB::table('order_status')->where('id', $request->order_status_id)->first();

    //send push notification when order update
    $firebaseToken = Customer::where('id', $getOrder->customer_id)->whereNotNull('firebase_token')->pluck('firebase_token')->all();

    $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');

    $data = [
      "registration_ids" => $firebaseToken,
      "notification" => [
        "title" => 'Order Status',
        "body" => 'Your order status change to ' . $getOrderStatusName->name . ' Order ID #' . $getOrder->id,
        "picture" => asset('assets') . '/img/shopping-bag.png'
      ]
    ];

    $dataString = json_encode($data);

    $headers = [
      'Authorization: key=' . $SERVER_API_KEY,
      'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);


    return redirect()->back()->with('success', 'Order Status Successfully Updated!');

  }
}