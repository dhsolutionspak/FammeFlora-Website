<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\NewsLatterSubscriber;
use App\Models\Setting;
use App\Models\Customer;
use App\Traits\CustomFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class MarketingController extends Controller
{
    use CustomFileTrait;
    protected $path = '';
    public function __construct() {
        $this->path = public_path(config('constant.file_path.manufacturer'));
    }

    public function index(Request $request)
    {
        //dd($request->all());
        $fdata['name'] = $request->get('name', '');
        $fdata['pagingntion'] = $this->defaultPaginate;
        $records = Manufacturer::GetManufacturer($fdata);
        return view('admin.manufacturer.index', ['records' => $records]);
    }

    public function add()
    {
        $fdata['pagingntion'] = $this->defaultPaginate;
        $alertMsg = $this->getAlertMsg();
        return view('admin.manufacturer.add')->with('AlertMsg','Confirm '.$alertMsg.' Before Submit!');
    }

    public function newslatterAdd()
    {
      return view('admin.newslatter.add');
    }

    public function newslatterSend(Request $request) {
        $getSubscriberEmail = NewsLatterSubscriber::getSubscriberEmail();
        foreach ($getSubscriberEmail as $key => $value) {
          $message = [
          'title'     => $request->title,
          'to_email'  => $value->email,
          'to_name'   => $value->email,
          'content' => $request->email_body
      ];
          Mail::send('admin.emails.newslatter', $message, function ($m) use($value,$request) {
              $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
              $m->to($value->email, $value->email)->subject($request->subject);

            });
        }

       return redirect()->back()->with('success', 'News Latter Succesfully Send To Users!');
    }

    public function smsmarketingAdd()
    {
      $getSubscriberTelephone = Customer::getSubscriberTelephone();

      return view('admin.smsMarketing.add', ['telephonesRecords' => $getSubscriberTelephone]);
    }

    public function smsmarketingSend(Request $request)
    {
        if($request->telephone_arr[0] == 1){
          $getSubscriberTelephone = Customer::getSubscriberTelephone();
          foreach ($variable as $key => $value) {
            $this->sendSMS($value->country_code.''.$value->telephone,$request->textmessege);
          }

        } else {
            if(!empty($request->telephone_arr)){
              foreach ($request->telephone_arr as $key => $mobile) {
                $this->sendSMS($mobile,$request->textmessege);
              }
            }
        };
       return redirect()->back()->with('success', 'SMS Succesfully Send To Users!');
    }


}
