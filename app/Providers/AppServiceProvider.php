<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //set default language
        try{
          if(!session()->get('currentLanguage')) {
            $currentLanguage = Language::where('default_lang','1')->first();
            if(!$currentLanguage) {
              $currentLanguage = Language::where('code','en')->first();
            }

            session()->put('currentLanguage',$currentLanguage->id);
            session()->put('language_flag',$currentLanguage->language_flag);
            session()->put('language_name',$currentLanguage->language_name);
            session()->save();
            app()->setLocale($currentLanguage->code);
            }
        }
        catch (\Exception $e) {

        }


        Paginator::useBootstrap();

    }
}
