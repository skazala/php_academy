<?php
namespace Vehicles;

use Exception;

abstract class Vehicle {

    private string $brand;
    private float $fuel_level;
    private float $tank_volume;
    private float $consumption;
    private int $vehicle_id;
    public static $id_registry = [];
    
    /**
     * __construct
     *
     * @param  mixed $brand
     * @param  mixed $fuel_level
     * @param  mixed $tank_volume
     * @param  mixed $consumption
     * @param  mixed $vehicle_id
     * @return void
     */
    public function __construct($brand, $fuel_level, $tank_volume, $consumption, $vehicle_id)
    {
        $this->brand = $brand;
        $this->fuel_level = $fuel_level;
        $this->tank_volume = $tank_volume;
        if ($this->fuel_level > $this->tank_volume)  
            throw new Exception('The fuel level can\'t be more than the tank volume!');
        $this->consumption = $consumption;
        $this->vehicle_id = $vehicle_id;
        if (in_array($this->vehicle_id, self::$id_registry)) {  
            throw new Exception('ID must be unique!');
        } else
            self::$id_registry[] = $this->vehicle_id;
    }
    
    /**
     * __clone
     *
     * @return void
     */
    public function __clone()
    {
        $new_id = rand(1000,100000);
        while (in_array($new_id, self::$id_registry)  && count(self::$id_registry) < 99000)
            $new_id = rand(1000,100000);
        $this->vehicle_id = $new_id;    
        self::$id_registry[] = $this->vehicle_id;
    }

    public abstract function getInfo();
    
    /**
     * getRemainingFuel
     *
     * @return void
     */
    public function getRemainingFuel()
    {
        return $this->fuel_level;
    }
    
    /**
     * getBrand
     *
     * @return void
     */
    public function getBrand()
    {
        return $this->brand;
    }
    
    /**
     * getId
     *
     * @return void
     */
    public function getId()
    {
        return $this->vehicle_id;
    }

    /**
     * getTank
     *
     * @return void
     */
    public function getTank()
    {
        return $this->tank_volume;
    }
    
    public function getConsumption()
    {
        return $this->consumption;
    }
    /**
     * isEmptyTank
     *
     * @return boolean
     */
    public function isEmptyTank(): bool
    {
        if ($this->fuel_level === floatval(0))
            return true;
        return false;
    }
    
    /**
     * addFuel
     *
     * @param float $litres
     * @return void
     */
    public function addFuel(float $litres)
    {
        if ($litres < 0)
            throw new Exception('You can\'t add negative amount of fuel!');
        if ($this->fuel_level + $litres <= $this->tank_volume)
            $this->fuel_level += $litres;
        else
            throw new Exception('Too much fuel to add!');
    }
    
    /**
     * drive
     *
     * @param float $distance
     * @return float
     */
    public function drive(float $distance): float
    {
        if ($distance < 0)
            throw new Exception('You can\'t drive negative amount of kilometers!');
        $fuel_used = $distance * $this->consumption / 100;

        if ($this->fuel_level - $fuel_used < 0) 
            throw new Exception('You can\'t ride for so long, not enought fuel!');    
        else
            $this->fuel_level -= $fuel_used;

        echo ('You have driven ' . $distance . ' kilometers!<br />');
        
        return $fuel_used;
    }
}