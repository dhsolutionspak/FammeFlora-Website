<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxRate extends Model
{
    use SoftDeletes;
    protected $table = 'tax_rate';
    protected $fillable = ['name','rate','type','status','zone_id'];
    const ACTIVE = 1;


    public static function getActivePluck() {
        return self::select('name','id')->active()->pluck('name','id');
    }

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVE);
    }

    public function geoZone() {
      return $this->hasOne('App\Models\GeoZone','id','zone_id');
    }
}
