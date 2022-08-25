<?php

use IVehicles\IVehicle;
use VehicleCreators\VehicleCreator;
use Vehicles\Petrol\PetrolVehicle;

class PetrolVehicleCreator extends VehicleCreator
{
    public function makeVehicle(array $params): IVehicle
    {
        // return new PetrolVehicle('Ford', 25, 50, 5, 2001);
        return new PetrolVehicle($params['brand'], 
                                $params['fuel_level'], 
                                $params['tank_volume'], 
                                $params['consumption'], 
                                $params['vehicle_id']
                            );
    }
}