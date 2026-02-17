<?php

namespace Modules\Order\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Models\Order;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => User::factory(),
            'status'            => $this->faker->randomElement(OrderStatus::class)->value,
            'total_in_cents'    => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
