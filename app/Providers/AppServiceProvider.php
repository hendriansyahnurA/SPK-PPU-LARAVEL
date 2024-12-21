<?php

namespace App\Providers;

use App\Models\Peserta;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });
        View::composer('components.Dashboard.cardHeader', function ($view) {
            $user = User::where('role', 'user')->get();
            $view->with('user', $user);
        });

        View::composer('components.Dashboard.cardHeader', function ($view) {
            $peserta = Peserta::all();
            $view->with('peserta', $peserta);
        });
    }
}