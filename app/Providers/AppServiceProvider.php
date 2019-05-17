<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
// use Validator;

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

        // Validator::extend('date_greater_than', function($attribute, $value, $parameters, $validator) {
        //     $inserted = Carbon::parse($value)->year;
        //     $since = $parameters[0];
        //     return $inserted >= $since && $inserted<= Carbon::now()->year;
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
