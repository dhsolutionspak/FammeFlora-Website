<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\ProductOptionDescription;
use App\Traits\CustomFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    use CustomFileTrait;
    protected $path = '';

    public function __construct() {
        $this->path = public_path(config('constant.file_path.product_option'));
    }

    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = ProductOption::select('id','type','status')
        ->with('adminproductoptionDescription')
        ->when($name != '', function($q) use($name) {
            $q->whereHas('adminproductoptionDescription',function($q) use($name){
                $q->where('name','like',"%$name%");
            });
          })->orderBy('created_at','DESC')->paginate($this->defaultPaginate);

        return view('admin.product_option.index',['records' => $records]);
    }

    public function add() {
        return view('admin.product_option.add');
    }

    protected function validateData ($request) {
        $this->validate($request, [
            'multilanguage.*.name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:20']
        ],[
          'multilanguage.*.name.required' => 'Name is required'
        ]);
    }

    public function store(Request $request) {
        $this->validateData($request);
        $data = new ProductOption($request->only('type','status'));
        $data->save();

        // if(ProductOption::CheckType($request->type)) {
        // }

        $decriptionModel =  new ProductOptionDescription();
        $buildMultiLanguage = $decriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $decriptionModel->upsert($buildMultiLanguage,['option_id','language_id','name']);

        return redirect(route('product-option'))->with('success','Option Created Successfully');
    }

    protected function getOptionArray($id) {
        $dataArray = [];
        $optionValue = request()->option_value;
        foreach($optionValue['name'] as $key => $value) {
            $image = null;
            $image = $this->saveCustomFileAndGetImageName($optionValue['image'][$key],$this->path);

            $dataArray[] = [
                'name' => $optionValue['name'][$key],
                'product_option_id' => $id,
                'sort_order' => $optionValue['sort_order'][$key],
                'image' => $image
            ];
        }
        return $dataArray;
    }

    public function edit($id) {

        $optionValueArray = [];
        // dd(ProductOption::with('optionMultipleDescription')->findOrFail($id));
        return view('admin.product_option.edit',[
            'data' => ProductOption::with('optionMultipleDescription')->findOrFail($id),
            'optionValueArray' => $optionValueArray,
        ]);
    }

    public function update(Request $request,$id) {
        $this->validateData($request);
        $data = ProductOption::findOrFail($id);
        $data->fill($request->only('name','type','status'))->save();

        $decriptionModel =  new ProductOptionDescription();
        $decriptionModel->where('option_id',$id)->delete();
        $buildMultiLanguage = $decriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $decriptionModel->upsert($buildMultiLanguage,['option_id','language_id','name']);

        return redirect(route('product-option'))->with('success','Option Updated Successfully');
    }

    protected function deleteOptionValue($id) {
        $optionValue = ProductOptionValue::getOptionValueById($id);
        $oldValueImages = $optionValue->pluck('image','id')->toArray();
        foreach($oldValueImages as $key => $value) {
            $this->removeOldImage($value,$this->path);
        }
        ProductOptionDescription::where('option_id',$id)->delete();
        ProductOptionValue::where('product_option_id',$id)->delete();
    }


    public function delete($id) {
        if(! $data = ProductOption::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $data->delete();
        ProductOptionDescription::where('option_id',$id)->delete();

        return redirect(route('product-option'))->with('success', 'Option  Deleted Successfully');
    }
}
