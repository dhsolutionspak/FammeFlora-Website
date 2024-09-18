<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributeGroup;
use App\Models\ProductAttributeGroupDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductAttributeGroupController extends Controller
{
    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = ProductAttributeGroup::with('AdminProductAttributeGroupDescription:language_id,attribute_group_id,name')
            ->select('id','status')
            ->when($name != '', function($q) use($name) {
              $q->whereHas('AdminProductAttributeGroupDescription',function($q) use($name){
                  $q->where('name','like',"%$name%");
              });
            })->orderBy('created_at','DESC')->paginate($this->defaultPaginate);

        return view('admin.product_attribute_group.index',['records' => $records]);
    }

    public function add() {
        return view('admin.product_attribute_group.add');
    }

    protected function validateData ($request) {

        $uniqueRuleCode = 'unique:product_attribute_group_description';

        // if(Route::currentRouteName() == 'product-attribute-group.update') {
        //     $uniqueRuleCode = 'unique:product_attribute_group_description,name,'.$request->id;
        // }
        // $this->validate($request, [
        //     'name' => ['required', 'string', 'max:255', $uniqueRuleCode ]
        // ]);

        $this->validate($request, [
            'multilanguage.*.name' => ['required', 'string', 'max:255']
        ],[
          'multilanguage.*.name.required' => 'Name is required'
        ]);
    }

    public function store(Request $request) {
        $this->validateData($request);
        $data = new ProductAttributeGroup($request->only('status'));
        $data->save();

        $descriptionModel =  new ProductAttributeGroupDescription();
        $buildMultiLanguage = $descriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $descriptionModel->upsert($buildMultiLanguage,['attribute_group_id','language_id','name']);

        return redirect(route('product-attribute-group'))->with('success','Attribute Group Created Successfully');
    }

    public function edit($id) {

        return view('admin.product_attribute_group.edit',[
            'data' => ProductAttributeGroup::with('attributeGroupMultipleDescription')->findOrFail($id),
        ]);
    }

    public function update(Request $request,$id) {

        $this->validateData($request);
        $data = ProductAttributeGroup::findOrFail($id);

        $data->fill($request->only('status'))->save();

        $descriptionModel =  new ProductAttributeGroupDescription();
        $descriptionModel->where('attribute_group_id',$id)->delete();
        $buildMultiLanguage = $descriptionModel->buildMultiLang($data->id,$request->multilanguage);
        $descriptionModel->upsert($buildMultiLanguage,['attribute_group_id','language_id','name']);

        return redirect(route('product-attribute-group'))->with('success','Attribute Group Updated Successfully');
    }

    public function delete($id) {
        if(! $data = ProductAttributeGroup::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        $descriptionModel =  new ProductAttributeGroupDescription();
        $descriptionModel->where('attribute_group_id',$id)->delete();

        $data->delete();
        return redirect(route('product-attribute-group'))->with('success', 'Attribute Group  Deleted Successfully');
    }
}
