<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{

    public function index(Request $request) {
        $records = Contactus::latest()->paginate($this->defaultPaginate);
        $notificationID = $request->get('notificationID',0);
        if($notificationID != 0) {
          $notification = auth()->user()->notifications()->find($notificationID);
          if($notification) {
            $notification->delete();
          }
        }
        return view('admin.contactus.index',['records' => $records]);
    }

}
