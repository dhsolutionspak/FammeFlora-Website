<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductRelated;
use App\Models\StoreProductOption;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Language;
use App\Models\Product;
use App\Models\DOD;
use DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use robertogallea\LaravelPython\Services\LaravelPython;
use App\Notification\PanelNotification;
use Notification;
use Socialite;
use Mail;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    //view customer login
    public function customerGetRegister(Request $request)
    {
      return view('frontend.user.register');
    }

    //customer registration
    public function customerRegister(Request $request){

        $validator = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'signupemail'=> 'required|max:255',
            'telephone'=> 'required',
            'signuppassword'=> 'required|max:255',
            'comfirmPassword'=> 'required|same:signuppassword',
            'country_code' => 'required'
        ],[
          'firstName' => 'First name is required',
          'lastName' => 'Last name is required',
          'signupemail' => 'Email address is required',
          'telephone' => 'Mobile number is required',
          'signuppassword' => 'Password is required',
          'comfirmPassword' => 'Confirm password does not match',
          'country_code' => 'Country code required'

        ]);

        $customerArray = array(
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'email' => $request->signupemail,
            'country_code' => $request->country_code,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->signuppassword),
            'creation' => 'D'
        );

        $customer = Customer::create($customerArray);


        if($customer){
            $data = array('email'=>$request->signupemail,'password'=>$request->signuppassword);

            if (Auth::guard('customer')->attempt($data)) {
                $wishlistData = DB::table("wishlist")->where('customer_id',$customer->id)->pluck('product_id');
                $cartCount = DB::table("cart")->where('customer_id',$customer->id)->sum('quantity');

                /*************************************************************
                    email configuration uncomment this code after setting up mail port ,username and password in .env file
                ******************************************************************/
                try {
                  $getAlertEmails = config('settingConfig.config_alert_mail');
                  if (strpos($getAlertEmails, 'Register') !== false) {
                    Mail::send('admin.emails.registration', [], function ($m) use($request) {
                        $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
                        $m->to($request->signupemail, $request->firstName)->subject('Welcome To '.config('settingConfig.config_store_name'));
                      });
                  }
                } catch (\Exception $e) {

                }
                /*************************************************************
                    sms configuration
                ******************************************************************/
                  $getAlertSMS = config('settingConfig.config_alert_sms');
                  if (strpos($getAlertSMS, 'Register') !== false) {
                      $receiverNumber = $customer->country_code.''.$customer->telephone;
                      $message = config('settingConfig.config_registerSMSContent');
                      $this->sendSMS($receiverNumber,$message);
                  }

                $notiData = [
                     'title' => 'New Customer Registration',
                     'body' => 'New customer '.$customer->name.' has register to your website',
                     'url' => route('customer.edit',['id' => $customer->id]),
                 ];

                 $users = User::all();
                 Notification::send($users, new PanelNotification($notiData));

                return redirect(route('customer.getlogin'))->with('registerSuccess', "Success! Registration completed");
            }
            else {
              return redirect()->back()->with('autherror','Unable to login')->withInput();
            }
        } else{
            return back()->with("registererror", "Alert! Failed to register");
        }
    }

    //view customer login
    public function viewcustomerLogin(Request $request)
    {
      return view('frontend.user.login');
    }

    //customer login
    public function customerLogin(Request $request)
    {
        $validator = $request->validate([
            'email'=> 'required|max:255',
            'password'=> 'required|max:255'
        ],['email' => 'Email address is required','password' =>'Password is required']);

            $customer = Customer::select('id','email','image','image','firstname','lastname','telephone','creation')->where('email',$request->email)->first();
            if($customer)
            {
                $data = array('email'=>$request->email,'password'=>$request->password);
                if (Auth::guard('customer')->attempt($data)) {
                    //update cart table
                    DB::table('cart')->where('customer_id',$customer->id)->update(['session_id' =>session()->getId() ]);


                    return redirect('/user-dashboard')->with('loginSuccess','Login Success');
                }
                else
                {
                    return redirect()->back()->with('autherror','Email/Password Wrong')->withInput();
                }
            }
            else
            {
                return redirect()->back()->with('autherror','Customer not found')->withInput();
            }
        }

      //customer logout
      public function customerLogout() {
          Auth::guard('customer')->logout();
          return redirect('/');
      }

      //social login
      public function redirectToProvider($driver)
      {

        return Socialite::driver($driver)->redirect();
      }

      public function handleSocialCallBack($driver) {
        try {
             $user = Socialite::driver($driver)->user();

             if($user) {
                $userEmail = '';
                if($user->getEmail()) {
                  $userEmail = $user->getEmail();
                }
                else {
                  $userEmail =str_replace(' ','',$user->getName()).'.'.substr($user->getId(), 0, 4).'@facebook.com';
                }

               //check if exists
               $customer = Customer::where('email',$userEmail)->first();
               if($customer) {
                     $data = array('email'=>$userEmail,'password'=>$user->getId());

                     if (Auth::guard('customer')->attempt($data)) {
                         //update cart table
                         DB::table('cart')->where('customer_id',$customer->id)->update(['session_id' =>session()->getId() ]);
                         return redirect('/user-dashboard')->with('loginSuccess','Login Success');
                     }
                     else
                     {
                         return redirect()->back()->with('autherror','Email/Password Wrong')->withInput();
                     }
               }
               else {
                   //create user
                   $creation = '';
                   if($driver == 'google') {
                     $creation = "G";
                   }
                   else {
                     $creation = "F";
                   }
                   $customerArray = array(
                       'firstname' => $user->getName(),
                       'lastname' => $creation == 'G' ? $user->user['family_name'] : '',
                       'email' =>  $userEmail,
                       'password' => Hash::make($user->getId()),
                       'creation' => $creation,
                       'image' => $user->getAvatar()
                   );

                   $customer = Customer::create($customerArray);
                   if($customer) {
                       $data = array('email'=> $userEmail,'password'=>$user->getId());

                       if (Auth::guard('customer')->attempt($data)) {
                           $wishlistData = DB::table("wishlist")->where('customer_id',$customer->id)->pluck('product_id');
                           $cartCount = DB::table("cart")->where('customer_id',$customer->id)->sum('quantity');
                           DB::table('cart')->where('customer_id',$customer->id)->update(['session_id' =>session()->getId() ]);
                           return redirect('/user-dashboard')->with('loginSuccess','Login Success');

                           /*************************************************************
                               email configuration uncomment this code after setting up mail port ,username and password in .env file
                           ******************************************************************/
                           try {
                             $getAlertEmails = config('settingConfig.config_alert_mail');
                             if (strpos($getAlertEmails, 'Register') !== false) {
                               Mail::send('admin.emails.registration', [], function ($m) use($request) {
                                   $m->from(config('settingConfig.config_email'), config('settingConfig.config_store_name'));
                                   $m->to($request->signupemail, $request->firstName)->subject('Welcome To '.config('settingConfig.config_store_name'));
                                 });
                             }
                           } catch (\Exception $e) {

                           }
                           /*************************************************************
                               sms configuration
                           ******************************************************************/
                             $getAlertSMS = config('settingConfig.config_alert_sms');
                             if (strpos($getAlertSMS, 'Register') !== false) {
                                 $receiverNumber = $customer->country_code.''.$customer->telephone;
                                 $message = config('settingConfig.config_registerSMSContent');
                                 $this->sendSMS($receiverNumber,$message);
                             }

                           $notiData = [
                                'title' => 'New Customer Registration',
                                'body' => 'New customer '.$customer->name.' has register to your website',
                                'url' => route('customer.edit',['id' => $customer->id]),
                            ];

                            $users = User::all();
                            Notification::send($users, new PanelNotification($notiData));

                           return redirect(route('customer.getlogin'))->with('registerSuccess', "Success! Registration completed");
                       }
                       else {
                         return redirect()->back()->with('autherror','Unable to login')->withInput();
                       }
                   } else{
                       return back()->with("registererror", "Alert! Failed to register");
                   }
               }
             }
           } catch (\Exception $e) {

             return back()->with("registererror", "Alert! Failed to register");
          }

      }

      //delete user account
      public function customerDelete() {
        $customer = Auth::guard('customer')->user();
        if($customer) {
          Customer::where('email', $customer->email)->delete();
        }
        return redirect('/')->with('success','Account Delete');
      }

}
