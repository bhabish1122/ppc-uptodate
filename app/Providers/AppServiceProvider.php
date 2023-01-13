<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

use Illuminate\Http\Request;
use App\Config;

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
    public function boot(Request $request)
    {
        Builder::defaultStringLength(191);

        view()->composer('web.main.app', function ($view) use ($request){
            $view->with('config', Config::getConfig($request));
        });
    }
}
