<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryDescription extends Model
{
    protected $table = 'category_description';
    protected $fillable = ['category_id','name', 'meta_keyword', 'meta_title', 'meta_description'];
    protected $primaryKey = 'category_id';

    public static function parentCategory() {
        return CategoryDescription::with('category')->whereHas('category', function($q) {
            $q->where([ 'parent_id' => 0 ]);
        })->where('language_id',session()->get('currentLanguage'))->pluck('name','category_id');
    }

  public function category() {
        return $this->belongsTo('App\Models\Category','category_id','category_id');
    }

  public function buildMultiLang($id,$data) {

      $returnArr = [];
      foreach ($data as $key => $value) {

          $returnArr[] = [
            'category_id' => $id,
            'language_id' => $key,
            'name' => $value['name'],
            'meta_title' => $value['meta_title'],
            'meta_description' => $value['meta_description'],
            'meta_keyword' => $value['meta_keyword'],
          ];
      }
      return $returnArr;
  }

}
