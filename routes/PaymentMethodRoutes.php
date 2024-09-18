<?php
use App\Http\Controllers\Admin\PaymentMethodController;
Route::group(['prefix' => 'payment-methods'], function () {
  Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/', ['as' => 'payment-methods', 'uses' => 'index']);
     Route::get('/{id}/edit', ['as' => 'payment-methods.edit', 'uses' => 'edit']);
     Route::post('/{id}/update', ['as' => 'payment-methods.update', 'uses' => 'update']);
  });
});
