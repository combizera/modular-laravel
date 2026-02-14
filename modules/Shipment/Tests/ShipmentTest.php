<?php

use Modules\Shipment\Models\Shipment;

it('should be able to list a shipment', function () {
    $shipment = Shipment::factory()->create();

    expect($shipment->provider)->toBeString();
});
