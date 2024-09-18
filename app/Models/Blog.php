<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
  use SoftDeletes;

   protected $table = 'blog';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'image','author','views'
  ];

  public function blogDescription() {
      return $this->hasOne('App\Models\BlogDescription','blog_id','id')->where('language_id',session()->get('currentLanguage'));
  }

  public function adminblogDescription() {
      return $this->hasOne('App\Models\BlogDescription','blog_id','id')->where('language_id',4);
  }

  public function blogMultipleDescription() {
      return $this->hasMany('App\Models\BlogDescription','blog_id','id')->join('language', 'language.id', '=', 'blog_description.language_id');
  }

}
