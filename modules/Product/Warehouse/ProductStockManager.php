<?php

namespace Modules\Product\Warehouse;

use Modules\Product\Models\Product;

class ProductStockManager
{
    public function decrement(int $productId, int $stock): void
    {
        Product::query()->findOrFail($productId)->decrement('stock', $stock);
    }
}