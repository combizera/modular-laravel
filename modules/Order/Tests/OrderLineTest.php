<?php

use Modules\Order\Models\OrderLine;

it('should be able to list a order line', function () {
    $orderLine = OrderLine::factory()->create();

    expect($orderLine->quantity)->toBeInt();
});
