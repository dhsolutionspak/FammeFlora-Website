<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $table = 'customer';
    protected $fillable = ['firstname','lastname','image','email','telephone','password','status','creation','social_id','firebase_token','country_code'];

    const ACTIVE = 1;

    public static function getActivePluck() {
        return self::active()->get()->pluck('full_name', 'id');
    }

    public function review() {
        return $this->hasMany('App\Models\Review');
    }

    public static function getSubscriberTelephone() {
          $getALlUserMobileNumber = self::select('telephone','country_code')->where('country_code','!=',null)->get();
           return $getALlUserMobileNumber;
    }

    public function getFullNameAttribute(){
        return $this->firstname . ' ' . $this->lastname;
    }

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }

    public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
   public function getJWTCustomClaims()
   {
       return [];
   }
}
