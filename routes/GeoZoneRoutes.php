<?php
use App\Http\Controllers\Admin\GeoZoneController;
Route::group(['prefix' => 'geo-zone'], function () {
  Route::controller(GeoZoneController::class)->group(function () {
    Route::get('/', ['as' => 'geozone', 'uses' => 'index']);
    Route::get('/add', ['as' => 'geozone.add', 'uses' => 'add']);
    Route::post('/store', ['as' => 'geozone.store', 'uses' => 'store']);
    Route::get('/{id}/edit', ['as' => 'geozone.edit', 'uses' => 'edit']);
    Route::get('/{id}/delete]', ['as' => 'geozone.delete', 'uses' => 'delete']);
    Route::post('/{id}/update', ['as' => 'geozone.update', 'uses' => 'update']);

  });
});
