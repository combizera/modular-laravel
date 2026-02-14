<?php

use Modules\Order\Models\Order;

it('should be able to list a order', function () {
    $order = Order::factory()->create();

    expect($order->status)->toBeString();
});
