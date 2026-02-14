<?php

namespace Modules\Shipment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shipment\Models\Shipment;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 100),
            'provider_shipment_id' => $this->faker->uuid(),
            'provider' => $this->faker->randomElement(['DHL', 'FedEx', 'UPS']),
        ];
    }
}
