<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        //
        if(config('app.force_url')){
            $url = config('app.url');
            URL::forceRootUrl($url);
            if (strpos($url, 'https') !== false) {
                URL::forceScheme('https');
            }
        }
    }
}
