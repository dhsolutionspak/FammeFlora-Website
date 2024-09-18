<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
  public $timestamps = false;
  Protected $primaryKey = null;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['company_logo','company_name','gstin_no','company_phone_number','company_address','language','invoice_comment','show_company_address','show_product_image','show_gstin_number','show_customer_name','show_signature','enable_tax','invoice_layout','show_invoice_comment','invoice_prefix','thanks_msg' ,
  'youtube_channel',
  'number_of_hifz',
  'number_of_qari' ,
  'number_of_aalim',
  'number_of_mufti',
  'number_of_student' ,
  'number_of_teacher',
  'facebook_page_url',
  'contact_email'

];
}
