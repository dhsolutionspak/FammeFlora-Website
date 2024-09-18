<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'customer_id','product_id','quantity','size_id','colour_id'
    ];
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productDescription() {
        return $this->belongsTo(ProductDescription::class)->where('language_id',session()->get('currentLanguage'));
    }
}
