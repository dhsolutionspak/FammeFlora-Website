<?php

namespace App\Models;

use App\Traits\CustomFileTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Product extends Model
{
    use CustomFileTrait,SoftDeletes;
    protected $table = 'product';

    protected $fillable = [
        'category_id', 'model', 'quantity', 'stock_status_id', 'image',
        'manufacturer_id',  'price',  'tax_rate_id', 'date_available',
        'weight', 'weight_class_id', 'length', 'width', 'height', 'length_class_id',
         'sort_order', 'status','sku'
    ];

    public static $fillableValue = [   'category_id', 'model', 'quantity', 'stock_status_id', 'image',
      'manufacturer_id',  'price',  'tax_rate_id', 'date_available',
      'weight', 'weight_class_id', 'length', 'width', 'height', 'length_class_id',
       'sort_order', 'status'];

    const ACTIVE = 1;

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }

    public function setDateAvailableAttribute($value) {
        $this->attributes['date_available'] = $this->changeDateFormat($value,config('constant.date_format')['custom_date_format'],config('constant.date_format')['database_date_format']);
    }

    public function getDateAvailableAttribute($value) {
        return Carbon::parse($value)->format(config('constant.date_format')['custom_date_format']);
    }

    public function productDescription() {
        return $this->hasOne('App\Models\ProductDescription','product_id','id')->where('language_id',session()->get('currentLanguage'));
    }

    public function adminproductDescription() {
        return $this->hasOne('App\Models\ProductDescription','product_id','id')->where('language_id',4);
    }

    public function productMultipleDescription() {
        return $this->hasMany('App\Models\ProductDescription','product_id','id')->join('language', 'language.id', '=', 'product_description.language_id');
    }

    public function images() {
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }

    public function attributes() {
        return $this->hasMany('App\Models\ProductRelatedAttribute','product_id','id');
    }

    public function special() {
        return $this->hasOne('App\Models\ProductSpecial','product_id','id');
    }

    public function discountProduct() {
        return $this->hasMany('App\Models\ProductDiscount','product_id','id');
    }

    public function category () {
        return $this->belongsTo('App\Models\CategoryDescription','category_id','category_id')->where('language_id',session()->get('currentLanguage'));
    }

    public function admincategory () {
        return $this->belongsTo('App\Models\CategoryDescription','category_id','category_id')->where('language_id',4);
    }


    public function productRelated() {
        return $this->hasMany('App\Models\ProductRelated','product_id','id');
    }

    public function productManufacturer() {
        return $this->hasOne('App\Models\Manufacturer','id','manufacturer_id');
    }

    public function productReview() {
      return $this->hasMany('App\Models\Review','product_id','id');
    }


}
