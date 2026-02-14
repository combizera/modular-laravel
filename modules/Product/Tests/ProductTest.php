<?php

use Modules\Product\Models\Product;

it('should be able to list a product', function () {
    $product = Product::factory()->create();

    expect($product->name)->toBeString();
});
