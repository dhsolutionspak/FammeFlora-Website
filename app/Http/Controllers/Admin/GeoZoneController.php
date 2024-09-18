<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeoZone;
use App\Models\GeoZoneCountry;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GeoZoneController extends Controller
{
    protected $path = '';

    public function __construct()
    {

    }

    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = GeoZone::select('id','name','description')
            ->when($name != '', function($q) use($name) {
                $q->where('name','like',"%$name%");
            })->paginate($this->defaultPaginate);
        return view('admin.geozone.index',['records' => $records]);
    }

    public function add() {
        return view('admin.geozone.add',['countries' => Country::where('status','1')->get()]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $geozone = new GeoZone($request->only('name','description'));
        $geozone->save();

            $arr = [];
            foreach ($request->country_id as $key => $value ) {
                $arr[] = [
                    'zone_id' => $geozone->id,
                    'country_id' => $request->country_id[$key],
                    'state_id' => $request->state_id[$key],
                ];
            }
            GeoZoneCountry::insert($arr);
            return redirect(route('geozone'))->with('success','Geo Zone Created Successfully');
    }

    public function edit($id) {

        return view('admin.geozone.edit',[
            'data' => GeoZone::with('countries')->findOrFail($id),
            'geoZones' => GeoZoneCountry::where('zone_id',$id)->get(),
            'countries' => Country::where('status','1')->get(),
        ]);
    }

    public function update(Request $request,$id) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $find = GeoZone::findOrFail($id);
        $find->fill($request->only('name','description'))->save();
        $arr = [];
        foreach ($request->country_id as $key => $value ) {
            $arr[] = [
                'zone_id' => $id,
                'country_id' => $request->country_id[$key],
                'state_id' => $request->state_id[$key],
            ];
        }

        $oldData = GeoZoneCountry::where('zone_id',$id)->get();
        $oldIds = $oldData->pluck('id')->toArray();

        GeoZoneCountry::whereIn('id',$oldIds)->delete();
        GeoZoneCountry::insert($arr);

        return redirect(route('geozone'))->with('success','Geo Zone Updated Successfully');
    }

    public function delete($id) {
        if(! $data = GeoZone::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        GeoZone::where('id',$id)->delete();
        GeoZoneCountry::where('zone_id',$id)->delete();

        return redirect(route('geozone'))->with('success', 'Geo Zone Deleted Successfully');
    }
}
