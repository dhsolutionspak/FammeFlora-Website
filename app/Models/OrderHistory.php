<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable = ['order_id', 'order_status_id', 'notify', 'comment'];
    protected $table = 'order_history';


    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status_id', 'id');
    }

}