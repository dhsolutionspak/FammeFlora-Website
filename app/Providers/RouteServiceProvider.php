<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
  protected $namespace = 'App\Http\Controllers';
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
     public const HOME = 'admin/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->configureRateLimiting();
    }

    public function map()
    {
      $this->mapWebRoutes();
      $this->mapApiRoutes();
      //$this->mapInstallRoutes();
    }

    //api routes
    protected function mapApiRoutes()
    {
      Route::prefix('api')
          ->middleware('api')
          ->namespace($this->namespace)
          ->group(base_path('routes/api.php'));
    }

    //web routes
    protected function mapWebRoutes()
    {
      Route::middleware('web')
      ->namespace($this->namespace)
      ->group(base_path('routes/web.php'));
    }

    //installation routes first time
    protected function mapInstallRoutes()
    {
      Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/installation.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
