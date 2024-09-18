<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Models\TaxClass;
use App\Models\TaxRate;
use App\Models\GeoZone;
use App\Models\GeoZoneCountry;
use DB;
use Twilio\Rest\Client;
use App\Http\Controllers\Api\CartApiController;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public $defaultPaginate = 10;
  public $defaultPaginateFrontend = 16;

  //cat parent child function
  function buildTree($elements, $parentId = 0, $limit = 100)
  {
    $branch = array();
    $i = 1;
    foreach ($elements as $element) {
      if ($element['parent_id'] == $parentId) {
        if ($i < $limit) {
          $children = $this->buildTree($elements, $element['category_id']);

          if ($children) {
            $element['children'] = $children;
          }
          $branch[] = $element;
        }
        $i++;
      }
    }

    return $branch;
  }

  public function buildProductObj($data)
  {
    $productObj = [];
    if (isset($data)) {
      foreach ($data as $key => $value) {
        $productObj[] = [
          'id' => $value->id,
          'image' => $value->image,
          'category_id' => $value->category_id,
          'model' => $value->model,
          'price' => $value->price,
          'quantity' => $value->quantity,
          'sort_order' => $value->sort_order,
          'status' => $value->status,
          'date_available' => $value->date_available,
          'created_at' => $value->created_at,
          'viewed' => $value->viewed,
          'review_avg' => $value->review_avg,
          'productDescription' => $value->productDescription,
          'category' => $value->category,
          'special' => $value->special
        ];
      }
    }
    return $productObj;
  }

  function getChatGPTConfig()
  {
    return DB::table('chatgpt_config')->first();
  }

  function sendSMS($receiverNumber, $message)
  {
    /*************************************************************
        sms configuration
    ******************************************************************/
    try {
      $account_sid = config("settingConfig.config_twilio_sid");
      $auth_token = config("settingConfig.config_twilio_token");
      $twilio_number = config("settingConfig.config_twilio_from");
      $client = new Client($account_sid, $auth_token);
      $client->messages->create($receiverNumber, [
        'from' => $twilio_number,
        'body' => $message
      ]);
    } catch (\Exception $e) {

    }
  }

  //build Seo
  function buildSeo($title, $keywordArr = [], $url, $desc)
  {
    SEOMeta::setTitle($title);
    SEOMeta::setDescription($desc);
    SEOMeta::addKeyword($keywordArr);
    OpenGraph::setDescription($desc);
    OpenGraph::setTitle($title);
    OpenGraph::setUrl($url);
    TwitterCard::setTitle($title);
  }


  //calculate zone wise tax
  public function calculateZoneTax($addressID, $userID = 0)
  {
    if ($userID != 0) {
      $getCart = CartApiController::getCartData();
    } else {
      $getCart = session()->get('cart' . session()->getId());
    }

    $findAddress = DB::table('customer_address')
      ->where('customer_address.id', $addressID)
      ->first();

    $calculatedTax = [];

    //get taxable products only
    foreach ($getCart['cartData'] as $key => $value) {

      if ($value['tax_class_id'] > 0) {
        //find tax class
        $findTaxClass = TaxClass::with('taxRules')->findOrFail($value['tax_class_id']);

        if ($findTaxClass) {

          foreach ($findTaxClass->taxRules as $t => $taxRule) {
            //find tax rates
            $getTaxRates = TaxRate::find($taxRule->tax_rate_id);

            if ($getTaxRates) {

              $getTaxZones = GeoZone::find($getTaxRates->zone_id);

              if ($getTaxZones) {
                $getTaxStateCountry = GeoZoneCountry::where('zone_id', $getTaxRates->zone_id)
                  ->where('country_id', $findAddress->country_id)
                  ->get();

                //apply tax after verify zones
                if ($getTaxStateCountry) {
                  //check tax area
                  $doCalculate = false;
                  foreach ($getTaxStateCountry as $c => $country) {
                    if ($country->state_id != 0) {
                      if ($country->state_id == $findAddress->state_id) {
                        $doCalculate = true;
                      }
                    } else {
                      $doCalculate = true;
                    }
                  }
                  if ($doCalculate) {
                    $taxAMT = 0;
                    $productPrice = $value['totalPrice'];
                    //if tax type percentage
                    if ($getTaxRates->type == 1) {
                      $taxAMT = $productPrice / 100 * $getTaxRates->rate;
                    } else if ($getTaxRates->type == 2) {
                      $taxAMT = $productPrice + $getTaxRates->rate;
                    }
                    $calculatedTax[] = [
                      'taxName' => $getTaxRates->name,
                      'taxAmount' => $taxAMT,
                      'tax_rate_id' => $getTaxRates->id,
                      'product_id' => $userID > 0 ? $value['id'] : $value['pid']
                    ];
                  }

                }
              }
            }
          }
        }
      }
    }

    //build final tax array
    $finaTaxArr = [];
    $names = array_column($calculatedTax, 'taxName');
    $taxAmount = array_column($calculatedTax, 'taxAmount');

    $unique_names = array_unique($names);

    foreach ($unique_names as $key => $name) {
      $this_keys = array_keys($names, $name);
      $qty = array_sum(array_intersect_key($taxAmount, array_combine($this_keys, $this_keys)));
      $taxRate = $calculatedTax[$key]['tax_rate_id'];
      $finaTaxArr[] = array("taxName" => $name, "taxAmount" => number_format($qty, 2), "tax_rate_id" => $taxRate);
    }

    if ($userID > 0) {
      $grandTotal = 0;
    } else {
      $sessionCartData = session()->get('cart' . session()->getId());
      $grandTotal = $sessionCartData['grandTotal'];

      //check coupon
      $counponHistory = DB::table('coupon_history')
        ->where('is_valid', 1)
        ->where('session_id', session()->getId())
        ->where('order_done', 0)
        ->first();

      $grandTotal = $sessionCartData['grandTotal'];

      $discountAMT = 0;
      if ($counponHistory) {
        if ($counponHistory->coupon_type == 1) {
          $subTotal = preg_replace('/[ ,]+/', '', $sessionCartData['subTotal']);
          $discountAMT = $subTotal / 100 * $counponHistory->amount;
        } else {
          $discountAMT = $counponHistory->amount;
        }
      }
      if ($discountAMT > 0) {
        $grandTotal -= $discountAMT;
      }
      session()->put('TAX_DATA' . session()->getId(), $finaTaxArr);
    }

    return ['tax' => $finaTaxArr, 'grandTotal' => $grandTotal];
  }

}