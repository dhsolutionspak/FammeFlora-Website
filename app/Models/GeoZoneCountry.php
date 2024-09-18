<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeoZoneCountry extends Model
{
    protected $table = 'geo_zone_countries';
    public $timestamps = false;

    protected $fillable = ['zone_id','country_id','state_id'];

    public function geoZone() {
        return $this->belongsTo('App\Models\GeoZone','id','zone_id');
    }
}
