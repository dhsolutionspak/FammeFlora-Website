<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttributeGroup extends Model
{
    use SoftDeletes;
    protected $fillable = ['status'];
    const ACTIVE = 1;

    public function relationAttributes() {
        return $this->hasMany('App\Models\ProductAttribute','group_id','id')
        ->join('product_attribute_description','product_attribute_description.attribute_id','=','product_attributes.id')
        ->wherenull('product_attribute_description.deleted_at')
        ->where('product_attribute_description.language_id','=',session()->get('currentLanguage'));
    }

    public function adminrelationAttributes() {
        return $this->hasMany('App\Models\ProductAttribute','group_id','id')
        ->join('product_attribute_description','product_attribute_description.attribute_id','=','product_attributes.id')
        ->wherenull('product_attribute_description.deleted_at')
        ->where('product_attribute_description.language_id','=',4);
    }

    public static function getActivePluck() {
        return self::active()
        ->join('product_attribute_group_description','product_attribute_group_description.attribute_group_id','=','product_attribute_groups.id')
        ->where('product_attribute_group_description.language_id',session()->get('currentLanguage'));
    }

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }

    public function ProductAttributeGroupDescription() {
        return $this->hasOne('App\Models\ProductAttributeGroupDescription','attribute_group_id','id')
        ->where('language_id',session()->get('currentLanguage'));
    }

    public function AdminProductAttributeGroupDescription() {
        return $this->hasOne('App\Models\ProductAttributeGroupDescription','attribute_group_id','id')
        ->where('language_id',4);
    }

    public function attributeGroupMultipleDescription() {
        return $this->hasMany('App\Models\ProductAttributeGroupDescription','attribute_group_id','id')->join('language', 'language.id', '=', 'product_attribute_group_description.language_id');
    }

}
