<?php

use Modules\Order\Enums\OrderStatus;
use Modules\Order\Models\Order;

it('should be able to list a order', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::COMPLETED,
    ]);

    expect($order->status)->toBe(OrderStatus::COMPLETED);
});
