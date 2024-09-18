<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeoZone extends Model
{
    protected $table = 'geo_zone';
    use SoftDeletes;
    protected $fillable = ['name','description'];

    public function countries() {
        return $this->hasMany('App\Models\GeoZoneCountry','zone_id','id');
    }
}
