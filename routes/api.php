<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GeneralApiController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\CartApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['checkKey'])->group(function () {
  Route::get('testAPI', function () {
    return response()->json(['status' => 1, 'message' => 'Test Done!']);
  });

  Route::controller(GeneralApiController::class)->group(function () {
    Route::get('/getHomePageInit', 'getHomePageInit');
    Route::get('/getHomePage', 'getHomePage');
    Route::get('/checkCache', 'checkCache');
    Route::get('/setCacheFalse', 'setCacheFalse');
    Route::get('/getNewProducts', 'getNewProducts');
    Route::get('/getTrendingProducts', 'getTrendingProducts');
    Route::get('/getDODProducts', 'getDODProducts');
    Route::get('/getCategories', 'getCategories');
    Route::get('/getManufacturers', 'getManufacturers');
    Route::get('/searchProducts', 'searchProducts');
    Route::get('/productDetail/{id?}', 'productDetails');
    Route::post('/incrementProductView/{id?}', 'incrementProductView');
    Route::get('/getProductByCategory/{id?}', 'getProductByCategory');
    Route::get('/getProductByManufacturer/{id?}', 'getProductByManufacturer');
    Route::get('/getPages/{id?}', 'getPages');
    Route::get('checkLogin', 'checkLogin');
    Route::get('getPaymentMethods', 'getPaymentMethods');
    Route::post('ai-image-search', 'imageSimilarity');
  });
});

Route::group(['prefix' => 'user'], function () {
  Route::controller(ApiAuthController::class)->group(function () {
    Route::post('/checkcustomer', 'checkcustomer');
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/loginUsingMobile', 'loginUsingMobile');
    Route::post('/socialLogin', 'socialLogin');
    Route::post('/socialRegister', 'socialRegister');
    Route::get('/logout', 'logout');
    Route::post('/forgotPassword', 'forgotPasswordEmail');
    Route::post('/verifyOTP', 'verifyOTP');
    Route::post('/resetPassword', 'resetPassword');
    Route::get('/deleteAccount', 'deleteAccount');

  });

  Route::middleware(['CustomerAuthAPI'])->group(function () {
    Route::controller(CustomerApiController::class)->group(function () {
      Route::get('getCustomer', 'getCustomerDetails');
      Route::post('updateProfile', 'updateProfile');
      Route::post('addUpdateWishlist', 'addUpdateWishlist');
      Route::get('getWishlist', 'getWishlist');
      Route::post('changePassword', 'changePassword');
      Route::post('changeProfilePicture', 'changeProfilePicture');
      Route::post('/addAddress', 'addAddress');
      Route::post('/editAddress/{id?}', 'editAddress');
      Route::post('/deleteAddress/{id?}', 'deleteAddress');
      Route::post('/addReview', 'addReview');
      Route::get('/getAdress', 'getAdress');
    });

    //cart functionality
    Route::controller(CartApiController::class)->group(function () {
      Route::post('/addToCart', 'addToCart');
      Route::get('/getCart', 'getCart');
      Route::post('/updateCart', 'updateCart');
      Route::post('/deleteCart', 'deleteCart');
      Route::post('/applyCoupon', 'applyCoupon');
      Route::get('/getCheckoutData', 'getCheckoutData');
      Route::post('/selectShipping/{id?}', 'selectShipping');
      Route::post('/placeOrder', 'placeOrder');
      Route::get('/getOrdersList', 'getOrdersList');
      Route::post('/cancelOrder', 'cancelOrder');
      Route::get('getOrderTimeline/{id?}', 'getOrderTimeline');
      Route::post('/calculate-tax', 'calculateTax');

    });
  });
});