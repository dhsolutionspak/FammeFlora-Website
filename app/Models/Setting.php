<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['store_id', 'key', 'value'];
    public $timestamps = false;
    const ConfigStoreImage = 'config_store_image';
    const ConfigIconImage = 'config_icon_image';
    const ConfigImage = 'config_image';
    const ConfigAlertMail = 'config_alert_mail';
    const ConfigAlertSMS = 'config_alert_sms';

    public static $imageArray = [self::ConfigStoreImage,self::ConfigIconImage,self::ConfigImage];

    public static function getMaxRowNumber() {
        $maxNumber = self::max('store_id');
        return $maxNumber == 0 ? 1 : $maxNumber+1;
    }

    public static function setKeyValueArray($key,$value) {
        return [
          'key' => $key,
          'value' => $value
        ];
    }

    public static function getconfigAlertMailArray ($configAlertMail,$maxId) {
        $configAlertMailArray = [];
        if(count($configAlertMail)) {
            $configAlertMail = implode(',',$configAlertMail[Setting::ConfigAlertMail]);
            $configAlertMailArray = Setting::setKeyValueArray(Setting::ConfigAlertMail,$configAlertMail);
            $configAlertMailArray['store_id'] = $maxId;
        }

        return $configAlertMailArray;
    }

    public static function getconfigAlertMSMSArray ($configAlertMail,$maxId) {
        $configAlertMailArray = [];
        if(count($configAlertMail)) {
            $configAlertMail = implode(',',$configAlertMail[Setting::ConfigAlertSMS]);
            $configAlertMailArray = Setting::setKeyValueArray(Setting::ConfigAlertSMS,$configAlertMail);
            $configAlertMailArray['store_id'] = $maxId;
        }

        return $configAlertMailArray;
    }

    public static function stringToArrayConversion($configAlertMail) {
        return explode(',', $configAlertMail);

    }


    public static function setInputValue($data, $fieldName, $returnValue = '') {
        return isset($data[$fieldName]) ? $data[$fieldName] : $returnValue;
    }

    public static function deleteByStoreId($id) {
        Setting::select('value')->where('store_id', $id)->delete();
    }



}
