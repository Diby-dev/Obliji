<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // 👈 AJOUTEZ CETTE LIGNE

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
        // 👈 AJOUTEZ CETTE LIGNE
        // Ce fix est nécessaire pour les anciennes versions de MySQL/MariaDB
        // qui limitent la taille des index utf8mb4.
        Schema::defaultStringLength(191); 
    }
}