<?php

use IVehicles\IVehicle;
use VehicleCreators\VehicleCreator;
use Vehicles\Diesel\DieselVehicle;

class DieselVehicleCreator extends VehicleCreator
{
    /**
     * makeVehicle
     *
     * @param array $params
     * @return IVehicle
     */
    public function makeVehicle(array $params): IVehicle
    {
        return new DieselVehicle($params['brand'], 
                                $params['fuel_level'], 
                                $params['tank_volume'], 
                                $params['consumption'], 
                                $params['vehicle_id']
                            );
    }
}