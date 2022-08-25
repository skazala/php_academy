<?php

namespace VehicleCreators;

use IVehicles\IVehicle;

abstract class VehicleCreator
{
    // Factory method
    abstract protected function makeVehicle(array $params): IVehicle;

    public function goTravelling100($params)
    {
        $car = $this->makeVehicle($params);
        $car->drive(100.0);
    }
}