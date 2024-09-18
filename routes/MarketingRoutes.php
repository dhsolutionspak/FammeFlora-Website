<?php
use App\Http\Controllers\Admin\MarketingController;

// Route::group(['prefix' => 'marketing'], function () {
  Route::controller(MarketingController::class)->group(function () {
  //  Route::get('/', ['as' => 'marketing', 'uses' => 'index']);

    Route::get('/newslatteradd', ['as' => 'newslatter.add', 'uses' => 'newslatterAdd']);
    Route::POST('/newslattersend', ['as' => 'newslatter.send', 'uses' => 'newslatterSend']);

    Route::get('/emailmarketingadd', ['as' => 'emailmarketing.add', 'uses' => 'emailmarketingAdd']);
    Route::POST('/emailmarketingsend', ['as' => 'emailmarketing.send', 'uses' => 'emailmarketingSend']);

    Route::get('/smsmarketingadd', ['as' => 'smsmarketing.add', 'uses' => 'smsmarketingAdd']);
    Route::post('/smsmarketingsend', ['as' => 'smsmarketing.send', 'uses' => 'smsmarketingSend']);

    // Route::post('/store', ['as' => 'marketing.store', 'uses' => 'store']);
    // Route::get('/{id}/edit', ['as' => 'marketing.edit', 'uses' => 'edit']);
    // Route::get('/{id}/delete]', ['as' => 'marketing.delete', 'uses' => 'delete']);
    // Route::post('/{id}/update', ['as' => 'marketing.update', 'uses' => 'update']);
 });
// });
