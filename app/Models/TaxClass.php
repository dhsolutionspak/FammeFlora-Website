<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxClass extends Model
{
    protected $table = 'tax_class';
    protected $primaryKey = 'tax_class_id';

    use SoftDeletes;
    protected $fillable = ['name','description'];

    public function taxRules() {
        return $this->hasMany('App\Models\TaxRules','tax_class_id','tax_class_id');
    }

    public static function getActivePluck() {
        return self::select('name','tax_class_id')->pluck('name','tax_class_id');
    }
}
