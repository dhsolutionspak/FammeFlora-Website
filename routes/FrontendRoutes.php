<?php
use App\Http\Controllers\Frontend\GeneralController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CustomerController;

//auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/customer-register',['as' => 'customer.getregister', 'uses' => 'customerGetRegister']);
    Route::post('/customer-register',['as' => 'customer.register', 'uses' => 'customerRegister']);
    Route::get('/customer-login',['as' => 'customer.getlogin', 'uses' => 'viewcustomerLogin']);
    Route::post('/customer-login',['as' => 'customer.login', 'uses' => 'customerLogin']);
    Route::get('/customer-logout',['as' => 'customer.logout', 'uses' => 'customerLogout']);
    Route::get('/customer-delete',['as' => 'customer.delete', 'uses' => 'customerDelete']);

    //social login
    Route::get('/auth/{driver}', [AuthController::class, 'redirectToProvider']);
    Route::get('/{driver}/callback', [AuthController::class, 'handleSocialCallBack']);

});

//paypal payment geteway
Route::get('success-transaction', [CartController::class, 'paypalSuccess'])->name('paypal.successTransaction');
Route::get('cancel-transaction', [CartController::class, 'paypalFailed'])->name('paypal.cancelTransaction');

//mollie payment geteway
Route::get('mollie-success-transaction', [CartController::class, 'mollieSuccess'])->name('mollie.success');
Route::post('mollie-webhooks-transaction', [CartController::class, 'mollieTransaction'])->name('webhooks.mollie');

//paystack response
Route::get('paystack-webhooks-transaction', [CartController::class, 'paystackSuccess'])->name('webhooks.paystack');

//instamojo response
Route::get('instamojo-success-transaction', [CartController::class, 'instamojoSuccess'])->name('instamojo.success');

//general routes
Route::controller(GeneralController::class)->group(function () {
  Route::get('/', ['as' => 'home', 'uses' => 'index']);
  Route::get('/all-category', ['as' => 'category.all', 'uses' => 'allCategries']);
  Route::get('/{type}/all-products', ['as' => 'product.all', 'uses' => 'allProducts']);
  Route::get('/category/{id}/productsajax', ['as' => 'category.productsajax', 'uses' => 'getProductByCategoryAjax']);
  Route::get('/category/{id}/products', ['as' => 'category.products', 'uses' => 'getProductByCategory']);
  Route::get('/brand/{id}/products', ['as' => 'brands.products', 'uses' => 'getProductByBrands']);
  Route::get('/product/{id}', ['as' => 'product.details', 'uses' => 'productDetails']);
  Route::post('/product/search', ['as' => 'product.search', 'uses' => 'productSearch']);
  Route::get('/productPrice/{id}', ['as' => 'product.price', 'uses' => 'productPrice']);

  //cms pages routes
  Route::get('/cms/{title?}', ['as' => 'get.cms', 'uses' => 'getcms']);

  //contact us
  Route::get('/contact_us',['as' => 'contact_us','uses' => 'getcontactus']);
  Route::post('/post-contact-us', ['as' => 'post-contact-us', 'uses' => 'contactus']);

  //news latter
  Route::post('newslatter',['as' => 'submit.newslatter','uses' => 'newslatter']);

  //change language
  Route::post('setLanguage',['as' => 'setLanguage','uses' => 'setLanguage']);

  //blog
  Route::get('/all-blogs',['as' =>'blog.all','uses'=>'allBlog']);

  //blog details
  Route::get('/{id}/blog-detail',['as' =>'blog.detail','uses'=>'blogDetail']);

  //single product details
  Route::post('/product-detail',['as' =>'product.detail','uses'=>'getProductDetails']);

  //search products
  Route::get('search-product',['as' => 'search-product','uses' => 'searchProduct']);

  //get states by country
  Route::post('get-states',['as' => 'get-states','uses' => 'getStates']);
});

  //cart controller
  Route::controller(CartController::class)->group(function () {
    Route::post('/add-to-cart',['as' => 'addtocart', 'uses' => 'addToCart']);
    Route::get('/shoppingCart', ['as' => 'shopping.cart', 'uses' => 'getCart']);
    Route::post('/update-quantity', ['as' => 'updateQty.cart', 'uses' => 'updateCart']);
    Route::post('/remove-item', ['as' => 'delete.cart', 'uses' => 'deleteCart']);
    Route::post('/apply-coupon', ['as' => 'apply.coupon', 'uses' => 'applyCoupon']);
    Route::get('/checkout', ['as' => 'checkout', 'uses' => 'getCheckout']);
    Route::post('/select-shipping', ['as' => 'select.shipping', 'uses' => 'selectShipping']);
    Route::post('/do-checkout', ['as' => 'doCheckout', 'uses' => 'placeOrder']);
    Route::post('/create-payment-intent', ['as' => 'create-payment-intent', 'uses' => 'createStripePaymentIntent']);
    Route::get('/payment-success', ['as' => 'payment-success', 'uses' => 'paymentSuccess']);
    Route::post('/calculate-tax',['as' => 'calculate-tax','uses' => 'calculateTax']);
  });

  Route::controller(CustomerController::class)->group(function () {
      Route::post('/add-address',['as' => 'add.address', 'uses' => 'addAddress']);
      Route::post('/get-address',['as' => 'get.address', 'uses' => 'getAddress']);
      Route::post('/update-address',['as' => 'update.address', 'uses' => 'editAddress']);
  });

  //customer auth
  Route::middleware(['customerAuth'])->group(function () {
    //customer releted routes
    Route::controller(CustomerController::class)->group(function () {
      Route::post('/add-to-wishlist',['as' => 'addtowishlist', 'uses' => 'addUpdateWishlist']);
      Route::post('/stripe',['as' => 'stripe.post', 'uses' => 'editAddress']);
      Route::get('/my-order',['as' => 'my-order', 'uses' => 'getOrdersList']);
      Route::get('/user-dashboard',['as' => 'user-dashboard', 'uses' => 'userDashboard']);
      Route::post('/update-profile',['as' => 'update.profile', 'uses' => 'updateProfile']);
      Route::get('/orders-list', ['as' => 'get-orders', 'uses' => 'getOrdersList']);
      Route::get('/order-details/{id}', ['as' => 'order-details', 'uses' => 'orderDetails']);
      Route::get('/order-download-pdf/{id}', ['as' => 'order-download-pdf', 'uses' => 'orderDownloadPDF']);
      Route::post('/submit-review', ['as' => 'submit.review', 'uses' => 'addReview']);
      Route::get('/get-wishlist', ['as' => 'get.wishlist', 'uses' => 'getWishlist']);
      Route::get('/get-address', ['as' => 'get.address', 'uses' => 'getAdress']);
      Route::post('/delete-addrss', ['as' => 'delete.address', 'uses' => 'deleteAddress']);
      Route::get('/get-change-password', ['as' => 'getchange.password', 'uses' => 'getChangePassword']);
      Route::post('/change-password', ['as' => 'change.password', 'uses' => 'changePassword']);
    });
});


Route::get('/privacy-policy', function () {
    return view('frontend.privacy');
});
