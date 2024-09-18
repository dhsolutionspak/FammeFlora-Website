<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    // ,'description','tag'
    public $timestamps = false;
    protected $table = 'product_description';
    protected $fillable = ['product_id','short_description','description','name','meta_title','meta_description','meta_keyword'];

    public static function getActivePluck() {
      return ProductDescription::join('product','product.id','=','product_description.product_id')
      ->pluck('name', 'product_id');
    }

    public static function getActiveSpecialPluck() {
      return ProductDescription::join('product','product.id','=','product_description.product_id')
      ->join('product_special','product_special.product_id','=','product_description.product_id')
      ->where('product_description.language_id',session()->get('currentLanguage'))
      ->pluck('product_description.name', 'product_description.product_id','product.image','product.price','product_special.price as specialPrice');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }


    public function buildMultiLang($id,$data) {
        $returnArr = [];
        foreach ($data as $key => $value) {
            $returnArr[] = [
              'product_id' => $id,
              'language_id' => $key,
              'name' => $value['name'],
              'description' => $value['description'],
              'short_description' => $value['short_description'],
              'meta_title' => $value['meta_title'],
              'meta_description' => $value['meta_description'],
              'meta_keyword' => $value['meta_keyword']
            ];
        }
        return $returnArr;
    }


}
