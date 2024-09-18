<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'category';

    protected $fillable = ['parent_id','image','sort_order','status'];

    protected $primaryKey = 'category_id';

    const ACTIVE = 1;

    public function categoryDescription() {
        return $this->hasOne('App\Models\CategoryDescription','category_id','category_id')
        ->where('language_id',session()->get('currentLanguage'));
    }

    public function admincategoryDescription() {
        return $this->hasOne('App\Models\CategoryDescription','category_id','category_id')
        ->where('language_id',4);
    }

    public function categoryDescriptionNoLang() {
        return $this->hasMany('App\Models\CategoryDescription','category_id','category_id');
    }

    public function categoryMultipleDescription() {
        return $this->hasMany('App\Models\CategoryDescription','category_id','category_id')->join('language', 'language.id', '=', 'category_description.language_id');
    }

    public static function getActivePluck() {
                return CategoryDescription::whereHas('category', function($q) {
                    $q->active();
                })->where('language_id',session()->get('currentLanguage'))->pluck('name','category_id');
    }

    public static function getAdminActivePluck() {
                return CategoryDescription::whereHas('category', function($q) {
                    $q->active();
                })->where('language_id',4)->pluck('name','category_id');
    }

    public static function getSellerActivePluck($sellerID) {
//        CategoryDescription::select('name','status','category_id')->whereHas()
                return CategoryDescription::whereHas('category', function($q) use($sellerID){
                    $q->active();
                    $q->where([ 'seller_id' => $sellerID ]);
                })->pluck('name','category_id');
    }


    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }
}
