<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Modules\Order\Actions\CreateOrder;
use Modules\Order\Exceptions\PaymentFailedException;
use Modules\Order\Http\Request\CheckoutRequest;
use Modules\Payment\PayBuddy;
use Modules\Product\CartItemCollection;

class CheckoutController
{
    public function __construct(
        protected CreateOrder $createOrder,
    )
    {
        //
    }

    public function __invoke(CheckoutRequest $request): JsonResponse
    {
        $cartItems = CartItemCollection::fromCheckoutData($request->input('products'));

        try {
            $order = $this->createOrder->handle(
                $cartItems,
                PayBuddy::make(),
                $request->input('payment_token'),
                $request->user()->id
            );
        } catch (PaymentFailedException) {
            throw ValidationException::withMessages([
                'payment_token' => 'We could not complete your payment.'
            ]);
        }

        return response()->json([
            'order_url' => $order->url()
        ], 201);
    }
}
