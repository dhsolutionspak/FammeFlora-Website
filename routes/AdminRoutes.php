<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\AI_Controller;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'index'])->name('get.dashboard');

//Image similarity
Route::get('/AI-Image-Similarity', [AI_Controller::class, 'getSimilarity'])->name('get.AI-image-similarity');
Route::get('/create-products-zip', [AI_Controller::class, 'createZipFile'])->name('create-products-zip');
Route::post('/upload-products-zip', [AI_Controller::class, 'uploadZipFile'])->name('upload-products-zip');
Route::post('/setting-up-model', [AI_Controller::class, 'settingUpModel'])->name('setting-up-model');
Route::post('/update-image-similarity-config', [AI_Controller::class, 'setImageSimilarity'])->name('update.image-similarity-config');

//Chat GPT Setup
Route::get('/AI-chatGPT', [AI_Controller::class, 'getChatGPT'])->name('get.AI-chatGPT');
Route::post('/update-chatGPT-config', [AI_Controller::class, 'updateChatGPTConfig'])->name('update.chatGPT-config');
Route::post('/ask-chat-gpt', [AI_Controller::class, 'getContentFromChatGPT'])->name('get-content-from-chatGPT');
Route::post('/seo-content-chat-gpt', [AI_Controller::class, 'getSeoContentFromChatGPT'])->name('get-seo-content-from-chatGPT');

Route::post('/fetch-states', [HomeController::class, 'fetchStates'])->name('fetch-states');

Route::get('/unauthorize', function () {
    return view('admin.unauth');
});


//'check_permission'
Route::middleware(['check_permission'])->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'password']);
    });

    include('CategoryRoutes.php');
    include('BannerRoutes.php');
    include('CountryRoutes.php');
    include('StateRoutes.php');
    include('TaxRateRoutes.php');
    include('StockStatusRoutes.php');
    include('LengthClassRoutes.php');
    include('WeightClassRoutes.php');
    include('CustomerRoutes.php');
    include('ReviewRoutes.php');
    include('ManufacturerRoutes.php');
    include('OrderStatusRoutes.php');
    include('ProductRoutes.php');
    include('ProductOptionRoutes.php');
    include('OrderRoutes.php');
    include('CouponRoutes.php');
    include('Blog.php');
    include('RoleRoutes.php');
    include('PermissionRoutes.php');
    include('UserRoutes.php');
    include('ProductAttributeGroupRoutes.php');
    include('ProductAttributeRoutes.php');
    include('PagesRoutes.php');
    include('DODRoutes.php');
    include('ShippingRoutes.php');
    include('LanguageRoutes.php');
    include('SettingRoutes.php');
    include('MarketingRoutes.php');
    include('PaymentMethodRoutes.php');
    include('GeoZoneRoutes.php');

    Route::controller(SupportController::class)->group(function () {
        Route::get('/contact-us', ['as' => 'contact-us', 'uses' => 'index']);
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', ['as' => 'notifications', 'uses' => 'index']);
        Route::post('/notifications/store', ['as' => 'notifications.store', 'uses' => 'store']);
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/featured-product', ['as' => 'featured-product', 'uses' => 'featuredProduct']);
        Route::post('/add-featured-product', ['as' => 'featured-product.store', 'uses' => 'addFeaturedProduct']);
        Route::get('/homepage-category', ['as' => 'homepage_category', 'uses' => 'homepageCategory']);
        Route::post('/store-homepage-category', ['as' => 'homepage-category.store', 'uses' => 'storeHomepageCategory']);
        Route::post('/homepage-category-sort-order', ['as' => 'homepageCategory.sort_order', 'uses' => 'homepageCategorySortOrder']);
    });

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
});

//clear cache & config
Route::get('clear-cache', [
    'as' => 'clear.cache',
    'uses' => function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->back()->with('success', 'Cleared');
    }
]);

//clear application cache
Route::get('clear.app.cache', [HomeController::class, 'clearApplicationCache'])->name('clear.app.cache');
