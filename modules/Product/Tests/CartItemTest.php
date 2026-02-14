<?php

use Modules\Product\Models\CartItem;

it('should be able to list a Card Item', function () {
    $cartItem = CartItem::factory()->create();

    expect($cartItem->quantity)->toBeInt();
});
