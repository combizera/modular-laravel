<?php

use Modules\Order\Providers\PaymentServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\Shipment\Providers\ShipmentServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    PaymentServiceProvider::class,
    ShipmentServiceProvider::class,
    ProductServiceProvider::class,
];
