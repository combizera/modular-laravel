<?php

namespace Modules\Order\Actions;

use Illuminate\Database\DatabaseManager;
use Modules\Order\Models\Order;
use Modules\Payment\Actions\CreatePaymentForOrder;
use Modules\Payment\PayBuddy;
use Modules\Product\CartItemCollection;
use Modules\Product\Warehouse\ProductStockManager;
use Throwable;

class CreateOrder
{
    public function __construct(
        protected ProductStockManager $productStockManager,
        protected CreatePaymentForOrder $createPaymentForOrder,
        protected DatabaseManager $databaseManager,
    )
    {
        //
    }

    /**
     * @param CartItemCollection $cartItems
     * @param PayBuddy $paymentProvider
     * @param string $paymentToken
     * @param int $userId
     * @return Order
     * @throws Throwable
     */
    public function handle(CartItemCollection $cartItems, PayBuddy $paymentProvider, string $paymentToken, int $userId): Order
    {
        return $this->databaseManager->transaction(function () use ($paymentToken, $paymentProvider, $cartItems, $userId) {
            $order = Order::startForUser($userId);
            $order->addLinesFromCartItems($cartItems);
            $order->fulfill();

            foreach ($cartItems->items() as $cartItem) {
                $this->productStockManager->decrement($cartItem->product->id, $cartItem->quantity);
            }

            $this->createPaymentForOrder->handle(
                $order->id,
                $userId,
                $cartItems->totalInCents(),
                $paymentProvider,
                $paymentToken
            );

            return $order;
        });
    }
}