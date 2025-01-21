<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        $profile_picture = null;
    
        if (auth()->check()) {
            // Verifica se o usuário tem uma foto de perfil
            $profile_picture = auth()->user()->profile_picture;
        }
    
        // Compartilha a variável em todas as views
        View::share('profile_picture', $profile_picture);
    }}