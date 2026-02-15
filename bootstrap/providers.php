<?php

use Modules\Order\Providers\OrderServiceProvider;
use Modules\Payment\Providers\PaymentServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\Shipment\Providers\ShipmentServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    OrderServiceProvider::class,
    PaymentServiceProvider::class,
    ShipmentServiceProvider::class,
    ProductServiceProvider::class,
];
