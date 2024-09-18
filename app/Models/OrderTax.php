<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTax extends Model
{
    protected $table = 'order_tax';
    public $timestamps = false;

    protected $fillable = ['order_id','tax_rate_id','tax_name','tax_amount'];


}
