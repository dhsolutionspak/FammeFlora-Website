<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DOD;
use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DealsOfTheDayController extends Controller
{
    public function index(Request $request) {
        $name = $request->get('name', '');
        $records = DOD::select('id','product_id')
            ->with('productDetails:id,image,price')
            ->with('productDescriptionAdmin:product_id,name')
            ->with('productSpecial:product_id,price')
            ->get();
        $data['pluckProducts'] =  ProductDescription::getActiveSpecialPluck();
        $data['pluckDODProducts'] = DOD::getPluck();

        return view('admin.dealoftheday.index',['records' => $records,'data' => $data]);
    }

    protected function validateData ($request) {
        $this->validate($request, [
            'product_id' => ['required']
        ]);
    }

    public function store(Request $request) {

        $this->validateData($request);
        DOD::truncate();
        $dodProducts = $this->getDODProduct($request->product_id);
        $data = DOD::insert($dodProducts);

        $getDodProducts = DOD::pluck('product_id')->toArray();

        $dodProductsArr = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','category_id','created_at')
                ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date',
                        'category:name,category_id'
                 )
                ->whereHas('special',function($q){
                    $q->where('start_date','<=',date('Y-m-d'));
                    $q->where('end_date','>=',date('Y-m-d'));
                 })
                ->where('date_available','<=',date('Y-m-d'))
                ->where('status','1')
                ->whereIn('id',$getDodProducts)
                ->orderBy('sort_order','ASC')
                ->take(5)
                ->get();

        $storeArr = $this->buildProductObj($dodProductsArr);

        $val = json_encode($storeArr);
        $filename = base_path().'/storage/app/dodProducts.json';
        $fp=fopen($filename,"w");
        fwrite($fp,$val);
        fclose($fp);

        return redirect(route('trending_dod'))->with('success','Deals Of The Day Added!');
    }

    protected function getDODProduct($productId) {
        $dataArray = [];
        if(isset($productId)) {
            foreach($productId as $key => $value) {
                $dataArray[] = [
                    'product_id' => $value,
                ];
            }
        }
        return $dataArray;
    }


}
