<?php
namespace Vehicles\Diesel;

use Exception;
use IVehicles\IVehicle as IVehiclesIVehicle;
use Vehicles\Vehicle;

class DieselVehicle extends Vehicle implements IVehiclesIVehicle 
{

    private int $filters = 100;

    /**
     * getFiltersStatus
     *
     * @return void
     */
    public function getFiltersStatus()
    {
        return $this->filters . '%';
    }

    /**
     * setNewFilters
     *
     * @return void
     */
    public function setNewFilters()
    {
        $this->filters = 100;
    }

    /**
     * drive
     *
     * @param float $distance
     * @return float
     */
    public function drive(float $distance): float
    {
        $fuel_used = parent::drive($distance);

        $this->useFilters($distance);

        return $fuel_used;
    }

    /**
     * getInfo
     *
     * @return array
     */
    public function getInfo(): array
    {
        $autoInfo = [];
        $autoInfo['brand'] = $this->getBrand();
        $autoInfo['fuel_level'] = $this->getRemainingFuel();
        $autoInfo['tank_volume'] = $this->getTank();
        $autoInfo['consumption'] = $this->getConsumption();
        $autoInfo['filters'] = $this->getFiltersStatus();     
        
        return $autoInfo;
    }

    /**
     * useFilters
     *
     * @param float $distance
     * @return void
     */
    private function useFilters(float $distance)
    {
        $wear = 0.1 * $distance; //0.1% per kilometer
        if ($this->filters - $wear < floatval(0))
            throw new Exception('You can\'t drive for so long, not enough filters.<br />');
        else
            $this->filters -= $wear;
    }
    
}