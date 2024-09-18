<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaxRate;
use App\Models\GeoZone;
use App\Models\TaxClass;
use App\Models\TaxRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = TaxRate::select('id','name','rate','type','status','zone_id')
            ->with('geoZone:id,name')
            ->when($name != '', function($q) use($name) {
                $q->where('name','like',"%$name%");
            })->orderBy('created_at','DESC')->paginate($this->defaultPaginate);

        return view('admin.tax_rate.index',['records' => $records]);
    }

    public function add() {
        return view('admin.tax_rate.add',['geozones' => GeoZone::get() ]);
    }

    protected function validateData ($request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'rate' => ['required'],
            'type' => ['required'],
        ]);
    }

    public function store(Request $request) {

        $this->validateData($request);
        $data = new TaxRate($request->only('name','rate','type','status','zone_id'));
        $data->save();

        return redirect(route('tax-rate'))->with('success','Tax Rate Created Successfully');
    }

    public function edit($id) {

        return view('admin.tax_rate.edit',[
            'data' => TaxRate::findOrFail($id),
            'geozones' => GeoZone::get()
        ]);
    }

    public function update(Request $request,$id) {

        $this->validateData($request);
        $data = TaxRate::findOrFail($id);
        $data->fill($request->only('name','rate','type','status','zone_id'))->save();

        return redirect(route('tax-rate'))->with('success','Tax Rate Updated Successfully');
    }

    public function delete($id) {
        if(! $data = TaxRate::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $data->delete();
        return redirect(route('tax-rate'))->with('success', 'Tax Rate  Deleted Successfully');
    }

    //Tax Class functions start from here
    public function indexClass(Request $request) {
      $name = $request->get('name', '');
      $records = TaxClass::select('tax_class_id','name','description')
          ->when($name != '', function($q) use($name) {
              $q->where('name','like',"%$name%");
          })->paginate($this->defaultPaginate);
      return view('admin.taxclass.index',['records' => $records]);
    }

    public function addClass() {
        return view('admin.taxclass.add',['taxRates' => TaxRate::where('status','1')->get()]);
    }

    //store tax class
    public function storeClass(Request $request) {
      $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
      ]);

      $taxClass = new TaxClass($request->only('name','description'));
      $taxClass->save();

          $arr = [];
          foreach ($request->tax_rate_id as $key => $value ) {
              $arr[] = [
                  'tax_class_id' => $taxClass->tax_class_id,
                  'tax_rate_id' => $request->tax_rate_id[$key],
              ];
          }
          TaxRules::insert($arr);
          return redirect(route('tax-class'))->with('success','Tax Class Created Successfully');
    }

    public function editClass($id) {

        return view('admin.taxclass.edit',[
            'data' => TaxClass::with('taxRules')->findOrFail($id),
            'taxRates' => TaxRate::where('status','1')->get()
        ]);
    }

    public function updateClass(Request $request,$id) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $find = TaxClass::findOrFail($id);
        $find->fill($request->only('name','description'))->save();
        $arr = [];

        foreach ($request->tax_rate_id as $key => $value ) {
            $arr[] = [
                'tax_class_id' => $id,
                'tax_rate_id' => $request->tax_rate_id[$key],
            ];
        }

        TaxRules::where('tax_class_id',$id)->delete();
        TaxRules::insert($arr);

        return redirect(route('tax-class'))->with('success','Tax Class Updated Successfully');
    }

    public function deleteClass($id) {
      TaxClass::where('tax_class_id',$id)->delete();
      TaxRules::where('tax_class_id',$id)->delete();

      return redirect(route('tax-class'))->with('success', 'Tax Class Deleted Successfully');
    }


}
