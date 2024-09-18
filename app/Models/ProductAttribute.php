<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{

    use SoftDeletes;
    protected $fillable = ['name', 'group_id', 'status'];

    public function productGroup() {
        return $this->belongsTo('App\Models\ProductAttributeGroup','group_id','id')
        ->join('product_attribute_group_description','product_attribute_group_description.attribute_group_id','=','product_attribute_groups.id')
        ->where('product_attribute_group_description.language_id',session()->get('currentLanguage'));
    }

    public function adminproductGroup() {
        return $this->belongsTo('App\Models\ProductAttributeGroup','group_id','id')
        ->join('product_attribute_group_description','product_attribute_group_description.attribute_group_id','=','product_attribute_groups.id')
        ->where('product_attribute_group_description.language_id',4);
    }

    public function productAttributeDescription() {
        return $this->hasOne('App\Models\ProductAttributeDescription','attribute_id','id')
        ->where('language_id',session()->get('currentLanguage'));
    }

    public function adminproductAttributeDescription() {
        return $this->hasOne('App\Models\ProductAttributeDescription','attribute_id','id')
        ->where('language_id',4);
    }

    public function attributeMultipleDescription() {
        return $this->hasMany('App\Models\ProductAttributeDescription','attribute_id','id')->join('language', 'language.id', '=', 'product_attribute_description.language_id');
    }


}
