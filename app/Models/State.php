<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    protected $primaryKey = 'state_id';

    use SoftDeletes;
    protected $fillable = ['name','country_id'];

    public function country() {
        return $this->hasOne('App\Models\Country','id','country_id');
    }
}
