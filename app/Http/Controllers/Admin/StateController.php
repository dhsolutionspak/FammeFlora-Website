<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StateController extends Controller
{
    protected $path = '';

    public function __construct()
    {

    }

    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = State::select('state_id','name','country_id')
            ->with('country:id,name')
            ->when($name != '', function($q) use($name) {
                $q->where('name','like',"%$name%");
            })->paginate($this->defaultPaginate);

        return view('admin.state.index',['records' => $records]);
    }

    public function add() {
        return view('admin.state.add',['countries' => Country::where('status','1')->get()]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'string', 'max:11'],
        ]);

        $geozone = new State($request->only('name','country_id'));
        $geozone->save();

        return redirect(route('state'))->with('success','State Created Successfully');
    }

    public function edit($id) {
        return view('admin.state.edit',[
            'data' => State::findOrFail($id),
            'countries' => Country::where('status','1')->get()
        ]);
    }

    public function update(Request $request,$id) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'string', 'max:255'],
        ]);
        $find = State::findOrFail($id);
        $find->fill($request->only('name','country_id'))->save();

        return redirect(route('state'))->with('success','State Updated Successfully');
    }

    public function delete($id) {

        State::where('state_id',$id)->delete();

        return redirect(route('state'))->with('success', 'State Deleted Successfully');
    }
}
