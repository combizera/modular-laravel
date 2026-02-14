<?php

namespace Modules\Product\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('product')
            ->name('product.')
            ->group(__DIR__ . '/../routes.php');
    }
}
