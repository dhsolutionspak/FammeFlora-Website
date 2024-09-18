<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Contactus extends Model
{
  use SoftDeletes,Notifiable;
  protected $table = 'contactus';
  protected $fillable = ['name','email','subject','message'];

}
