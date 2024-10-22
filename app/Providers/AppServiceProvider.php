<?php

namespace App\Providers;

use App\Models\Cintillo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();

        $cintillo = Cintillo::where('activo', 2)->first()->nombre;
        View::share('cintillo', $cintillo);
    }
}
