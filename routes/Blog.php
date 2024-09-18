<?php
use App\Http\Controllers\Admin\BlogController;

Route::group(['prefix' => 'blog'], function () {
  Route::controller(BlogController::class)->group(function () {
    Route::get('/', ['as' => 'blog','uses'=>'index']);
     Route::get('/add', ['as' => 'blog.add','uses'=>'add']);
     Route::post('/store', ['as' => 'blog.store','uses'=>'store']);
     Route::get('/{id}/edit', ['as' => 'blog.edit','uses'=>'edit']);
     Route::post('/{id}/update', ['as' => 'blog.update','uses'=>'update']);
     Route::get('{id}/delete]', ['as' => 'blog.delete','uses'=>'delete']);
  });
});
