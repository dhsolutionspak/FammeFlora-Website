<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Frontend\InstallationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => '/'], function () {
  include('FrontendRoutes.php');
});
Route::get('/privacy-policy', function () {
    return view('frontend.privacy');
});
Route::group(['prefix' => 'admin'], function () {
  Auth::routes();
});
Route::middleware(['auth'])->group(function () {
  Route::group(['prefix' => 'admin'], function () {
    include('AdminRoutes.php');
  });
});

Route::controller(InstallationController::class)->group(function () {
  Route::get('installation/success', 'installationSuccess')->name('installation-success');
});
