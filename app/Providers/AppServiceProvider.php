<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // \DB::listen(function ($query) {
        //     // \Log::debug($query->sql);
        //     // $query->bindings
        //     // $query->time
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
