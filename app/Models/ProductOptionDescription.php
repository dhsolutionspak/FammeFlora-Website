<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOptionDescription extends Model
{
    protected $table = 'product_option_description';
    protected $fillable = ['language_id','option_id', 'name'];
    protected $primaryKey = 'option_id';

    public function productOption() {
          return $this->belongsTo('App\Models\ProductOption','option_id','id');
    }

    public function buildMultiLang($id,$data) {
      $returnArr = [];
      foreach ($data as $key => $value) {
          $returnArr[] = [
            'option_id' => $id,
            'language_id' => $key,
            'name' => $value['name'],
          ];
      }
      return $returnArr;
  }

}
