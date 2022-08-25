<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vehicles\Petrol\PetrolVehicle;

final class PetrolVehicleTest extends TestCase 
{ 
    // protected PetrolVehicle $vehicle;

    // public static function setUpBeforeClass(): void
    // {
    //     self::$vehicle = new PetrolVehicle('Some brand', 10.5, 40, 1, 1000);
    // }
    
    public function testVehicleCreation()
    {
        // Arrange
        $vehicle = new PetrolVehicle('Some brand', 10.5, 40, 1, 1000); 

        // Act
        $plugs_status = $vehicle->getPlugsStatus();
        $fuel_level = $vehicle->getRemainingFuel();
        $brand = $vehicle->getBrand();
        $id = $vehicle->getId();

        // $plugs_status = $this->vehicle->getPlugsStatus();
        // $fuel_level = $this->vehicle->getRemainingFuel();
        // $brand = $this->vehicle->getBrand();
        // $id = $this->vehicle->getId();

        // Assert
        $this->assertSame('100%', $plugs_status, 'Error with plugs');
        $this->assertSame(10.5, $fuel_level);
        $this->assertSame('Some brand', $brand);
        $this->assertSame(1000, $id);

        return $vehicle;
    }

    /**
     * @depends testVehicleCreation
     */
    public function testVehicleCloning(PetrolVehicle $vehicle)
    {
        // Arrange
        $id = $vehicle->getId();

        // Act
        $clone = clone $vehicle;
        $id_clone = $clone->getId();

        // Assert
        $this->assertNotSame($id, $id_clone);
    }

    /**
     * @depends testVehicleCreation
     */
    public function testDrive(PetrolVehicle $vehicle)
    {
        $vehicle->drive(100);

        $this->assertSame(9.5, $vehicle->getRemainingFuel());

        return $vehicle;
    }

    /**
     * @depends testDrive
     */
    public function testAddingEnoughFuel(PetrolVehicle $vehicle)
    {
        // Act
        $vehicle->addFuel(10.0);
        $fuel_level = $vehicle->getRemainingFuel();

        // Assert
        $this->assertSame(19.5, $fuel_level);

        return $vehicle;
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionsWhenAddingFuel(PetrolVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('Too much fuel to add');

        // Act
        $vehicle->addFuel(30.5);

        // Assert
        $this->expectExceptionMessage('You can\'t add negative amount of fuel!');

        // Act
        $vehicle->addFuel(-0.5);
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionWithFuelWhenDriving(PetrolVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('You can\'t ride for so long, not enought fuel!');

        // Act
        $vehicle->drive(2000);
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionWithPlugsWhenDriving(PetrolVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('You can\'t drive for so long, not enough plugs.<br />');

        // Act
        $vehicle->drive(1200);
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionWithNegativeDistanceWhenDriving(PetrolVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('You can\'t drive negative amount of kilometers!');

        // Act
        $vehicle->drive(-600);
    }

    public function testUniqueIdWhenCreatingVehicle()
    {
        $this->expectErrorMessage('ID must be unique!');

        $petrol_vehicle = new PetrolVehicle('Some brand', 100, 100, 1, 1000);
    }

    public function testSettingFuelLevelMoreThanTankVolumeWhenCreatingVehicle()
    {
        $this->expectErrorMessage('The fuel level can\'t be more than the tank volume!');

        $petrol_vehicle = new PetrolVehicle('Some brand', 100, 10, 1, 1005);
    }
}