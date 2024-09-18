<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use SoftDeletes,Notifiable;

    protected $table = 'order';
    const INVOICE_PREFIX = 'INV';

    protected $fillable = ['invoice_no', 'invoice_prefix', 'customer_id', 'customer_group_id',
        'firstname', 'lastname', 'email', 'telephone', 'shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1', 'shipping_address_2',
        'shipping_city', 'shipping_postcode', 'shipping_country_id', 'shipping_address_format', 'shipping_method',
        'shipping_code','shipping_name', 'comment', 'total', 'order_status_id', 'commission', 'tracking', 'language_id','tax_amount','discount','shipping_charge','grand_total',
        'currency_code', 'currency_value','order_date', 'ip', 'forwarded_ip', 'user_agent', 'accept_language','payment_method','transaction_id','billing_name','billing_address_1',
        'billing_address_2','billing_city','billing_postcode','billing_country_id'
    ];

    public function productRelation() {
        return $this->hasMany('App\Models\OrderProduct','order_id','id');
    }

    public function orderStatus() {
        return $this->hasOne('App\Models\OrderStatus','id','order_status_id');
    }

    public function orderCountry() {
        return $this->hasOne('App\Models\Country','id','shipping_country_id');
    }

    public function products() {
        return $this->hasMany('App\Models\OrderProduct','order_id','id');
    }

    public function productCounts() {
      return $this->hasMany('App\Models\OrderProduct','order_id','id')->selectRaw('SUM(order_product.order_id) as payment_amount');
    }




}
