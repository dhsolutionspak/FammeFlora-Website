<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    // use SoftDeletes;
    protected $table = 'language';

    protected $fillable = ['language_name', 'language_flag', 'default_lang', 'code', 'status', 'sort_order'];

    protected $primaryKey = 'id';

    const ACTIVE = 1;

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }
}