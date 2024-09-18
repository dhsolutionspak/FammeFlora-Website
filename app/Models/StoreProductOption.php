<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductOption extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id','option_id','color_code','label','price','required'];
    protected $table = 'store_product_option';

    public function Product() {
      return $this->hasMany('App\Models\Product','id','product_id');
    }


    public function productoptionDescription() {
        return $this->hasOne('App\Models\ProductOptionDescription','option_id','option_id')
        ->where('language_id',session()->get('currentLanguage'));
    }

    public function adminproductoptionDescription() {
        return $this->hasOne('App\Models\ProductOptionDescription','option_id','option_id')
        ->where('language_id',4);
    }
}
