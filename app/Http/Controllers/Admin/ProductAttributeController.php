<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeDescription;
use App\Models\ProductAttributeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductAttributeController extends Controller
{
    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = ProductAttribute::with('adminproductGroup:name,id','adminproductAttributeDescription:language_id,attribute_id,name')
            ->select('id','group_id','status')
            ->when($name != '', function($q) use($name) {
              $q->whereHas('adminproductAttributeDescription',function($q) use($name){
                  $q->where('name','like',"%$name%");
              })->orWhereHas('productGroup',function($q) use($name){
                      $q->where('name','like',"%$name%");
                  });
            })->orderBy('created_at','DESC')->paginate($this->defaultPaginate);

        return view('admin.product_attribute.index',['records' => $records]);
    }

    public function add() {
        return view('admin.product_attribute.add',[
            'productAttributeGroup' => ProductAttributeGroup::getActivePluck()->get()
        ]);
    }

    protected function validateData ($request) {
        $this->validate($request, [
            'multilanguage.*.name' => ['required', 'string', 'max:255']
        ],[
          'multilanguage.*.name.required' => 'Name is required'
        ]);
    }

    public function store(Request $request) {
        $this->validateData($request);
        $data = new ProductAttribute($request->only('name','group_id','status'));
        $data->save();
        $descriptionModel =  new ProductAttributeDescription();
        $buildMultiLanguage = $descriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $descriptionModel->upsert($buildMultiLanguage,['attribute_id','language_id','name']);
        return redirect(route('product-attribute'))->with('success','Product Attribute Created Successfully');
    }

    public function edit($id) {
        return view('admin.product_attribute.edit',[
            'data' => ProductAttribute::with('attributeMultipleDescription')->findOrFail($id),
            'productAttributeGroup' =>ProductAttributeGroup::getActivePluck()->get()
        ]);
    }

    public function update(Request $request,$id) {

        $this->validateData($request);
        $data = ProductAttribute::findOrFail($id);
        $data->fill($request->only('name','group_id','status'))->save();
        $descriptionModel =  new ProductAttributeDescription();
        $descriptionModel->where('attribute_id',$id)->delete();
        $buildMultiLanguage = $descriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $descriptionModel->upsert($buildMultiLanguage,['attribute_id','language_id','name']);

        return redirect(route('product-attribute'))->with('success','Product Attribute Updated Successfully');
    }

    public function delete($id) {
        if(! $data = ProductAttribute::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $data->delete();
        $descriptionModel =  new ProductAttributeDescription();
        $descriptionModel->where('attribute_id',$id)->delete();

        return redirect(route('product-attribute'))->with('success', 'Product Attribute  Deleted Successfully');
    }
}
