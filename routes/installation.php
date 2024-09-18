<?php
/*
|--------------------------------------------------------------------------
| Installation Routes
|--------------------------------------------------------------------------
|
*/
use App\Http\Controllers\Frontend\InstallationController;

Route::controller(InstallationController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/checking-permission', 'checkingpermission')->name('checking-permission');
    Route::get('/database-setup', 'databaseSetup')->name('database.setup');
    Route::post('/db_installation', 'db_installation')->name('db.store');
    Route::get('/import-database', 'importdatabase')->name('import-database');
    Route::post('/db_import', 'dbimport')->name('do.importdb');
    Route::get('/finalize-app', 'finalizeApp')->name('finalize-app');
    Route::post('/configuresystem', 'configureSystem')->name('configuresystem');
    Route::get('installation/success', 'installationSuccess')->name('installation-success');
    Route::get('start-app', 'startApp')->name('start-app');
    Route::post('verify-purchase', 'verifyPurchase')->name('verify.purchase');


});
