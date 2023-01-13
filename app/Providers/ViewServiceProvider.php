<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\UsefulLink;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        dd('ok');
        View::composer('*', function($view)
        {
          $view->with('usefullinks', UsefulLink::where('is_active', true)->orderBy('sort_id','ASC')->orderBy('created_at','DESC')->get());
        });
    }
}