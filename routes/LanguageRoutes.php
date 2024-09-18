<?php
use App\Http\Controllers\Admin\LanguageController;

Route::group(['prefix' => 'language'], function () {
  Route::controller(LanguageController::class)->group(function () {
    Route::get('/', ['as' => 'language','uses' => 'index']);
    Route::get('/add', ['as' => 'language.add', 'uses' => 'add']);
    Route::post('/store', ['as' => 'language.store', 'uses' => 'store']);
    Route::get('/{id}/edit', ['as' => 'language.edit', 'uses' => 'edit']);
    Route::get('/{id}/delete]', ['as' => 'language.delete', 'uses' => 'delete']);
    Route::post('/{id}/update', ['as' => 'language.update', 'uses' => 'update']);
  });
});
