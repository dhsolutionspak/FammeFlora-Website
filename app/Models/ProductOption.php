<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOption extends Model
{
    protected $fillable = ['name', 'type', 'status'];
    use SoftDeletes;
    const ACTIVE = 1;

    public static function CheckType($type) {
        return in_array($type,config('constant.product_option')['Choose']);
    }

    public static function getActivePluck() {
        // return self::select('name','id','type')->active()->get();
        return ProductOptionDescription::whereHas('productOption', function($q) {
            $q->active();
        })->pluck('name','option_id');
    }

    public static function getProductActivePluck() {
        // return self::select('name','id','type')->active()->get();
        return ProductOptionDescription::whereHas('productOption', function($q) {
            $q->active();
        })->select('name','option_id')->where('language_id',session()->get('currentLanguage'))->get();
    }

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }

    public function optionMultipleDescription() {
        return $this->hasMany('App\Models\ProductOptionDescription','option_id','id')->join('language', 'language.id', '=', 'product_option_description.language_id');
    }

    public function productoptionDescription() {

        return $this->hasOne('App\Models\ProductOptionDescription','option_id','id')
        ->where('language_id',session()->get('currentLanguage'));
    }

    public function adminproductoptionDescription() {

        return $this->hasOne('App\Models\ProductOptionDescription','option_id','id')
        ->where('language_id',4);
    }


}
