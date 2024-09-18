<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethods extends Model
{
    use SoftDeletes;
    protected $table = 'payment_methods';

    protected $fillable = ['id','name','merchant_email','payment_key','payment_secret','payment_mode','payment_logo','payment_code','is_active','sort_order','payment_url'];

    protected $primaryKey = 'id';

    const ACTIVE = 1;

    public function scopeActive($query) {
        return $query->where('is_active', self::ACTIVE);
    }
}
