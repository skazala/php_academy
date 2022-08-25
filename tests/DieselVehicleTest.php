<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vehicles\Diesel\DieselVehicle;

final class DieselVehicleTest extends TestCase 
{ 
    public function testVehicleCreation()
    {
        // Arrange
        $vehicle = new DieselVehicle('Some brand', 10.5, 40, 1, 2000);

        // Act
        $filters_status = $vehicle->getFiltersStatus();
        $fuel_level = $vehicle->getRemainingFuel();
        $brand = $vehicle->getBrand();
        $id = $vehicle->getId();

        // Assert
        $this->assertSame('100%', $filters_status, 'Error with plugs');
        $this->assertSame(10.5, $fuel_level);
        $this->assertSame('Some brand', $brand);
        $this->assertSame(2000, $id);

        return $vehicle;
    }

    /**
     * @depends testVehicleCreation
     */
    public function testVehicleCloning(DieselVehicle $vehicle)
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
    public function testDrive(DieselVehicle $vehicle)
    {
        $vehicle->drive(100);

        $this->assertSame(9.5, $vehicle->getRemainingFuel());

        return $vehicle;
    }

    /**
     * @depends testDrive
     */
    public function testAddingEnoughFuel(DieselVehicle $vehicle)
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
    public function testExpectedExceptionsWhenAddingFuel(DieselVehicle $vehicle)
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
    public function testExpectedExceptionWithFuelWhenDriving(DieselVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('You can\'t ride for so long, not enought fuel!');

        // Act
        $vehicle->drive(2000);
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionWithFiltersWhenDriving(DieselVehicle $vehicle)
    {    
        // Assert
        $this->expectExceptionMessage('You can\'t drive for so long, not enough filters.<br />');

        // Act
        $vehicle->drive(1200);
    }

    /**
     * @depends testAddingEnoughFuel
     */
    public function testExpectedExceptionWithNegativeDistanceWhenDriving(DieselVehicle $vehicle)
    {
        // Assert
        $this->expectExceptionMessage('You can\'t drive negative amount of kilometers!');

        // Act
        $vehicle->drive(-600);
    }

    public function testUniqueIdWhenCreatingVehicle()
    {
        $this->expectErrorMessage('ID must be unique!');

        $vehicle = new DieselVehicle('Some brand', 100, 100, 1, 2000);
    }

    public function testSettingFuelLevelMoreThanTankVolumeWhenCreatingVehicle()
    {
        $this->expectErrorMessage('The fuel level can\'t be more than the tank volume!');

        $vehicle = new DieselVehicle('Some brand', 100, 10, 1, 2005);
    }
}