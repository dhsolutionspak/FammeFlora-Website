<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxRules extends Model
{
    protected $table = 'tax_rule';
    public $timestamps = false;

    protected $fillable = ['tax_class_id','tax_rate_id'];

    public function taxClass() {
        return $this->belongsTo('App\Models\TaxClass','tax_class_id','tax_class_id');
    }

  

}
