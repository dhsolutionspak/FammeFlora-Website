<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL;
use DB;
use Hash;
use App\Models\User;
use Artisan;
use Session;
use Illuminate\Support\Facades\File;

class InstallationController extends Controller
{
  public function index()
  {
    return view('installation.index');
  }
  public function verifyPurchase(Request $request) {
      if(empty($request->purchase_code)){
        return back()->with('commonError', 'Invalid purchase code')->withInput();
      }

      $validation = create_init($request->purchase_code);

        session()->put('purchaseID', 'Nulled by codingshop.net');
        session()->save();
        return redirect('checking-permission');

  }

  public function checkingpermission()
  {
    $purchaseCODE = session()->get('purchaseID');
      $permission['curl_enabled'] = function_exists('curl_version');
      $permission['db_file_write_perm'] = is_writable(base_path('.env'));
      $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
      return view('installation.checkingpermission', compact('permission'));


  }
  public function databaseSetup()
  {
    $purchaseCODE = session()->get('purchaseID');
     return view('installation.dbsetup');

  }

  public function db_installation(Request $request)
  {
    $purchaseCODE = session()->get('purchaseID');
    $validation = verify_code($purchaseCODE);
      if (self::check_database_connection($request->db_host, $request->db_name, $request->db_username, $request->db_password)) {
        $path = base_path('.env');
        if (file_exists($path)) {
          $this->writeEnvironmentFile('DB_HOST', $request->db_host);
          $this->writeEnvironmentFile('DB_DATABASE', $request->db_name);
          $this->writeEnvironmentFile('DB_USERNAME', $request->db_username);
          $this->writeEnvironmentFile('DB_PASSWORD', $request->db_password);

          return redirect('import-database');
        } else {
          return back()->with('commonError', 'Something wrong')->withInput();
        }
      } else {
        return back()->with('commonError', 'Invalid database connection')->withInput();
      }

  }

  public function importdatabase()
  {
    $purchaseCODE = session()->get('purchaseID');

      return view('installation.importDatabase');

  }

  public function dbimport()
  {
    $purchaseCODE = session()->get('purchaseID');

      ini_set('memory_limit', '-1');
      $sql_path = base_path('database/otrixcommerce_web.sql');
      $sql_dump = File::get($sql_path);
      DB::connection()->getPdo()->exec($sql_dump);
      return redirect('finalize-app');

  }

  public function writeEnvironmentFile($type, $val)
  {
    $path = base_path('.env');
    if (file_exists($path)) {
      $val = '"' . trim($val) . '"';
      file_put_contents(
        $path,
        str_replace(
          $type . '="' . env($type) . '"', $type . '=' . $val,
          file_get_contents($path)
        )
      );
    }
  }

  function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "")
  {
    if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
      return true;
    } else {
      return false;
    }
  }

  public function finalizeApp()
  {
    $purchaseCODE = session()->get('purchaseID');
 
      return view('installation.systemconfig');

  }

  public function configureSystem(Request $request)
  {

    $user = new User();
    $findUser = $user->where('id', 1)->first();

    $findUser->name = $request->admin_name;
    $findUser->email = $request->admin_email;
    $findUser->password = Hash::make($request->admin_password);
    $findUser->save();
    Artisan::call('key:generate');
    return redirect('installation/success');
  }

  public function installationSuccess()
  {
    $previousRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.php');
    $newRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.txt');
    copy($newRouteServiceProvier, $previousRouteServiceProvier);
    $this->writeEnvironmentFile('APP_DEBUG', false);
    return view('installation.success');
  }

  public function startApp()
  {
    return redirect('/');
  }

}
