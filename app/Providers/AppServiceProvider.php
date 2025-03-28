<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('rickApi', function () {
           return Http::baseUrl('https://rickandmortyapi.com/api')
               ->withHeaders([
                   'content-type' => 'application/json',
                   'accept' => 'application/json',
               ]);
        });
    }
}
