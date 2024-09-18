<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AdminController extends Controller
{
    public function index() {
        dd(bcrypt('arowpe@#recharge'));
        dd('Here Dynamic');
    }

    public function add() {
      $types = ['type1','type2'];
      return view('admin.customer.add',compact('types'));
    }

    public function store(Request $request) {

      // dd($request->all());

      $messsages = array(
        'firstname.required'=>'Name is Required',
        'firstname.min' => 'Minimum must be 4 onlyyy'
      );

      $rules = [
          // 'firstname' => 'required|min:4|max:6',
          // 'mobilenumber' => 'required|numeric|digits:10',
          'userimage' => 'required|image|mimes:jpg,png'
        ];

      $validator = Validator::make($request->all(), $rules,$messsages);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator) // send back all errors to the login form
              ->with('error', 'login')->withInput(); // send back the input (not the password) so that we can repopulate the form
      }

      echo 'Success';


    }

}
