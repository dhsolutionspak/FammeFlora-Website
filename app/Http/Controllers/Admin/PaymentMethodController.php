<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use App\Traits\CustomFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaymentMethodController extends Controller
{
    use CustomFileTrait;
    protected $path = '';

    public function __construct()
    {
        $this->path = public_path(config('constant.file_path.paymentmethod'));
    }

    public function index(Request $request) {
        $name = $request->get('name', '');
        $records = PaymentMethods::paginate($this->defaultPaginate);

        return view('admin.paymentmethods.index',['records' => $records]);
    }

    public function edit($id) {
        return view('admin.paymentmethods.edit',[
            'data' => PaymentMethods::findOrFail($id),
        ]);
    }

    public function update(Request $request,$id) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'payment_code' => ['required', 'string', 'max:255'],
        ]);
        $find = PaymentMethods::findOrFail($id);

        $find->fill($request->only('name','is_active','payment_key','payment_secret','payment_code','payment_mode','sort_order'))->save();
        if($request->hasFile('payment_logo')) {
          $this->createDirectory($this->path);
          $find->payment_logo = $this->saveCustomFileAndGetImageName(request()->file('payment_logo'),$this->path);
        }
        $find->save();

        if($request->payment_code == 'paystack') {
          $val  =		"<?php \n";
          $val  .= 	"return [\n";
          $val  .= " 'publicKey' => '".addslashes ($request->payment_key)."'  ,\n";
          $val  .= " 'secretKey' => '".addslashes ($request->payment_secret)."'  ,\n";
          $val  .= " 'paymentUrl' => 'https://api.paystack.co'  ,\n";
          $val  .= " 'merchantEmail' => '".addslashes ($request->merchant_email)."'  ,\n";
          $val  .= 	"];\n";
           $filename = base_path().'/config/paystack.php';
           $fp=fopen($filename,"w+");
           fwrite($fp,$val);
           fclose($fp);
        }

        return redirect(route('payment-methods'))->with('success','Payment Method Updated Successfully');
    }

    public function delete($id) {
        if(! $data = Banner::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $images = $data->images()->pluck('image');
        foreach($images as $key => $value) {
            $this->removeOldImage($value,$this->path);
        }
        Banner::where('id',$id)->delete();
        BannerImage::where('banner_id',$id)->delete();

        return redirect(route('banner'))->with('success', 'Banner  Deleted Successfully');
    }
}
