<?php include __DIR__ . '\\vendor\\autoload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car factory</title>
</head>
<body>
    <?php

        spl_autoload_register(function($class) {
            $array = explode("\\", $class);
            $class = $array[count($array)-1];
            require 'classes/' . $class . '.php';
        });
        
        // $car1 = new DieselVehicle('Ford', 25, 50, 5, 1001);
        // $car2 = clone $car1;
        // try {
        //     $car3 = new DieselVehicle('Ford', 25, 50, 5, 1001);
        // } catch (Exception $e) {
        //     echo 'Caught exception: ',  $e->getMessage(), '<br />';
        // }
        // $car4 = new PetrolVehicle('Kia', 0, 60, 7, 1002);
        // try {
        //     $car4->addFuel(50);
            
        //     echo ('Fuel used: ' . $car4->drive(90) . ' litres.<br />');
        //     echo ('Fuel left: ' . $car4->getRemainingFuel() . ' litres.<br />');
        //     echo ('Plugs capacity = ' . $car4->getPlugsStatus() . '<br />');
        // } catch (Exception $e) {
        //     echo 'Caught exception: ',  $e->getMessage(), '<br />';
        // }

        // $car1 = new PetrolVehicleCreator();
        // $fuel_used1 = $car1->goTravelling100(['brand' => 'BMW', 
        //                     'fuel_level' => 15,
        //                     'tank_volume' => 49.9,
        //                     'consumption' => 5,
        //                     'vehicle_id' => 4555
        //                 ]);
        // echo ('You have used ' . $fuel_used1 . ' litres of fuel.<br />');
        

        // $car2 = new DieselVehicleCreator();
        // $fuel_used2 = $car2->makeVehicle(['brand' => 'Toyota', 
        //                     'fuel_level' => 25,
        //                     'tank_volume' => 59.9,
        //                     'consumption' => 6,
        //                     'vehicle_id' => 4556
        //                 ])
        //      ->drive(100.0);
        // echo ('You have used ' . $fuel_used2 . ' litres of fuel.<br />');

        $controller = new Controller();
        $controller->processRequest();
    ?>
</body>
</html>