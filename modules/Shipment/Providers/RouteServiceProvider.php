<?php

namespace Modules\Shipment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('shipments')
            ->name('shipments.')
            ->group(__DIR__ . '/../routes.php');
    }
}
