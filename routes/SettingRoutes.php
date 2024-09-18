<?php
use App\Http\Controllers\Admin\SettingController;

Route::group(['prefix' => 'setting'], function () {
  Route::controller(SettingController::class)->group(function () {
    Route::get('/general-setting', ['as' => 'setting.general', 'uses' => 'index']);
    Route::get('/email-setting', ['as' => 'setting.email', 'uses' => 'index']);
    Route::get('/sms-setting', ['as' => 'setting.sms', 'uses' => 'index']);
    Route::get('/emailtemplate-setting', ['as' => 'setting.emailtemplate', 'uses' => 'index']);
    Route::get('/seo-setting', ['as' => 'setting.seo', 'uses' => 'index']);
    Route::get('/socialmedia-setting', ['as' => 'setting.socialmedia', 'uses' => 'index']);
    Route::get('/theme-setting',['as' => 'setting.websiteTheme','uses' => 'getWebsiteTheme']);
    Route::get('/label-setting', ['as' => 'setting.label', 'uses' => 'settingLabel']);
    Route::post('/label-setting-store', ['as' => 'setting.label-store', 'uses' => 'storeLabels']);
    Route::get('/add', ['as' => 'setting.add', 'uses' => 'add']);
    Route::post('/store', ['as' => 'setting.store', 'uses' => 'store']);
    Route::get('/{id}/edit', ['as' => 'setting.edit', 'uses' => 'edit']);
    Route::get('/{id}/delete]', ['as' => 'setting.delete', 'uses' => 'delete']);
    Route::post('/{id}/update', ['as' => 'setting.update', 'uses' => 'update']);
  });
});
