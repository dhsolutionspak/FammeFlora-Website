<?php
use App\Http\Controllers\Admin\TaxRateController;

  Route::controller(TaxRateController::class)->group(function () {
    Route::group(['prefix' => 'tax-rate'], function () {
      Route::get('/', ['as' => 'tax-rate', 'uses' => 'index']);
      Route::get('/add', ['as' => 'tax-rate.add', 'uses' => 'add']);
      Route::post('/store', ['as' => 'tax-rate.store', 'uses' => 'store']);
      Route::get('/{id}/edit', ['as' => 'tax-rate.edit', 'uses' => 'edit']);
      Route::get('/{id}/delete]', ['as' => 'tax-rate.delete', 'uses' => 'delete']);
      Route::post('/{id}/update', ['as' => 'tax-rate.update', 'uses' => 'update']);
    });
    Route::group(['prefix' => 'tax-class'], function () {
      Route::get('/', ['as' => 'tax-class', 'uses' => 'indexClass']);
      Route::get('/add', ['as' => 'tax-class.add', 'uses' => 'addClass']);
      Route::post('/store', ['as' => 'tax-class.store', 'uses' => 'storeClass']);
      Route::get('/{id}/edit', ['as' => 'tax-class.edit', 'uses' => 'editClass']);
      Route::get('/{id}/delete]', ['as' => 'tax-class.delete', 'uses' => 'deleteClass']);
      Route::post('/{id}/update', ['as' => 'tax-class.update', 'uses' => 'updateClass']);
    });
});
