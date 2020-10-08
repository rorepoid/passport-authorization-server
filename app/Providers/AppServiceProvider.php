<?php

namespace App\Providers;

use App\Models\Site;
use App\Observers\SiteObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::defaultView('pagination.tailwind');

        Paginator::defaultSimpleView('pagination.simple-tailwind');

        Site::observe(SiteObserver::class);
    }
}
