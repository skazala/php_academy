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
        use Nette\Http\RequestFactory;

        spl_autoload_register(function($class) {
            $array = explode("\\", $class);
            $class = $array[count($array)-1];
            require 'classes/' . $class . '.php';
        });
        
        $factory = new RequestFactory; 
        $httpRequest = $factory->fromGlobals();
                
        $controller = new Controller();
        $controller->processRequest($httpRequest);
    ?>
</body>
</html>