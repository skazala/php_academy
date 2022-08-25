<?php
namespace Vehicles\Petrol;

use Exception;
use IVehicles\IVehicle as IVehiclesIVehicle;
use Vehicles\Vehicle;

class PetrolVehicle extends Vehicle implements IVehiclesIVehicle
{

    private int $plugs = 95;

    /**
     * getPlugsStatus
     *
     * @return void
     */
    public function getPlugsStatus()
    {
        return $this->plugs . '%';
    }

    /**
     * setNewPlugs
     *
     * @return void
     */
    public function setNewPlugs()
    {
        $this->plugs = 100;
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

        $this->usePlugs($distance);

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
        $autoInfo['plugs'] = $this->getPlugsStatus();     
        
        return $autoInfo;
    }

    /**
     * usePlugs
     *
     * @param float $distance
     * @return void
     */
    private function usePlugs(float $distance)
    {
        $wear = 0.2 * $distance; //0.2% per kilometer
        if ($this->plugs - $wear < 0)
            throw new Exception('You can\'t drive for so long, not enough plugs.<br />');
        else
            $this->plugs -= $wear;
    }
}