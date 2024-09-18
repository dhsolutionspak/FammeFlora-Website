<?php
use App\Http\Controllers\Admin\StateController;

Route::group(['prefix' => 'state'], function () {
  Route::controller(StateController::class)->group(function () {
    Route::get('/', ['as' => 'state', 'uses' => 'index']);
    Route::get('/add', ['as' => 'state.add', 'uses' => 'add']);
    Route::post('/store', ['as' => 'state.store', 'uses' => 'store']);
    Route::get('/{id}/edit', ['as' => 'state.edit', 'uses' => 'edit']);
    Route::get('/{id}/delete]', ['as' => 'state.delete', 'uses' => 'delete']);
    Route::post('/{id}/update', ['as' => 'state.update', 'uses' => 'update']);
  });
});
