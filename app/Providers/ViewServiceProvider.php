<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\FileEngine;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Language;
use App\Models\Page;
use DB;

class ViewServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    //$this->registerFactory();
    //$this->registerViewFinder();
    //$this->registerBladeCompiler();
    //$this->registerEngineResolver();
    // $this->boot();
  }


  public function boot()
  {

    View::composer('frontend.layouts.app', function ($view) {
      $categories = Category::select('category_id', 'image', 'parent_id', 'sort_order', 'status')
        ->with('categoryDescription:name,category_id')
        ->where('status', '1')
        ->orderBy('sort_order', 'ASC')->get();

      $topCategory = $this->buildTree($categories, 0, 99);

      $cartCount = 0;
      $wishlistCount = 0;
      $wishlistData = [];
      if (Auth::guard('customer')->check()) {
        $wishlistCount = DB::table('wishlist')->where('customer_id', Auth::guard('customer')->user()->id)->count();
      }

      //cart count
      $cartCount = \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');

      $cmsPagesArr = file_get_contents(base_path() . '/storage/app/cmsPages.json');
      $cmsPages = json_decode($cmsPagesArr);

      $languagesArr = file_get_contents(base_path() . '/storage/app/languageArray.json');
      $languages = json_decode($languagesArr);

      $view->with('commonData', ['languages' => $languages, 'categories' => $topCategory, 'cartCount' => $cartCount, 'wishlistCount' => $wishlistCount, 'cmsPages' => $cmsPages]);
    });

  }

  function buildTree($elements, $parentId = 0, $limit = 100)
  {
    $branch = array();
    $i = 1;
    foreach ($elements as $element) {
      if ($element['parent_id'] == $parentId) {
        if ($i < $limit) {
          $children = $this->buildTree($elements, $element['category_id']);

          if ($children) {
            $element['children'] = $children;
          }
          $branch[] = $element;
        }
        $i++;
      }
    }

    return $branch;
  }

}