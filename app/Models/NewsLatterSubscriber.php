<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NewsLatterSubscriber extends Model
{
    protected $keyType = 'string';
    protected $table = 'newslatter';
    const ACTIVE = 1;
    public $timestamps = false;
    protected $fillable = ['email','status'];

    public static function getSubscriberEmail() {
         $getAllSubscriberMailId = NewsLatterSubscriber::select('email')->get();
         return $getAllSubscriberMailId;
   }
}
