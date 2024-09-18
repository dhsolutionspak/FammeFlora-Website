<?php
use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Facades\Http;


    function setPermissionValue($val1,$val2) {

         return $val1 == $val2 ? $val1 : "$val1.$val2";
    }

    function getPermissionGroupName($value) {
        $array = explode('.',$value);
         return $array[0];
    }

    function getLanguages() {
         return Language::where('status',1)->orderBy('created_at','ASC')->get();
    }

    function getCartCount() {
        return \App\Models\Cart::where('customer_id',\Illuminate\Support\Facades\Auth::guard('customer')->user()->id)->count();
    }

    function getWishlist() {
          return  DB::table("wishlist")->where('customer_id',Auth::guard('customer')->user()->id)->pluck('product_id')->toArray();
    }

    function getCategories() {
      $categoryArray =file_get_contents(base_path().'/storage/app/categoryArray.json');
      $categories = json_decode($categoryArray);
      return $categories;
    }

    function getProductOptions($id) {

      $getProduct = Product::select('product.id','product.model','order_product.options')
      ->join('order_product','order_product.product_id','=','product.id')
      ->where('product.id',$id)
      ->first();

      $decodeOptions = null;
      if($getProduct && $getProduct->options){

        $decodeOptions = unserialize($getProduct->options);
      }

      $rArry = ['model' => $getProduct ? $getProduct->model : 'N/A','options' =>  $decodeOptions];

      return $rArry;

    }

    //function verify purchase
    function create_init($code) {
        {
          if ($code == "") {
              return false;
          }

          try {

              $visit = "https://support.otrixcommerce.in/check/".$code;

              $stream = curl_init();

              // Check if initialization had gone wrong*
              if ($stream === false) {
                  throw new Exception('failed to initialize');
              }

              curl_setopt($stream, CURLOPT_URL, $visit);
              curl_setopt($stream, CURLOPT_HEADER, 0);
              curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($stream, CURLOPT_SSL_VERIFYHOST, FALSE);
              curl_setopt($stream, CURLOPT_SSL_VERIFYPEER, FALSE);
              $rn = curl_exec($stream);
              curl_close($stream);

              if ($rn == 'invalid') {
                  return false;
              }
              else {
                return $rn;
              }

          } catch (\Exception $e) {
          }

          return true;
      }
    }

    function verify_code($code) {
        {
          if ($code == "") {
              return false;
          }

          try {

              $visit = "https://support.otrixcommerce.in/verify-code/".$code;

              $stream = curl_init();

              // Check if initialization had gone wrong*
              if ($stream === false) {
                  throw new Exception('failed to initialize');
              }

              curl_setopt($stream, CURLOPT_URL, $visit);
              curl_setopt($stream, CURLOPT_HEADER, 0);
              curl_setopt($stream, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($stream, CURLOPT_SSL_VERIFYHOST, FALSE);
              curl_setopt($stream, CURLOPT_SSL_VERIFYPEER, FALSE);
              $rn = curl_exec($stream);
              curl_close($stream);

              if ($rn == 'invalid') {
                  return false;
              }
              else {
                return $rn;
              }

          } catch (\Exception $e) {
          }

          return true;
      }
    }


    function calculatePercentage($basePrice,$special) {
        $off = 0;
        $diff = $basePrice - $special;
        if($diff > 0) {
          $off = number_format($diff / $basePrice * 100,0);
        }
        return $off.'% Off';
    }

?>
