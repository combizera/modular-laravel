<?php

namespace Modules\Payment\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Payment\Models\Payment;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'payment_id' => (string) Str::uuid(),
            'total_in_cents' => random_int(100, 10000),
            'status' => 'paid',
            'payment_gateway' => 'PayBuddy',
        ];
    }
}
