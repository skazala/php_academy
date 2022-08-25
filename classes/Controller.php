<?php

use Nette\Http\RequestFactory;

class Controller
{
    protected $data = array();

    public function processRequest()
    {
        $factory = new RequestFactory; 
        $httpRequest = $factory->fromGlobals();
        $url = $httpRequest->getUrl();
        echo '<p>' . $url . '</p>';
        $vehicle_type = $httpRequest->getQuery('fuel');
        
        try {
            $className = ucfirst($vehicle_type) . 'Vehicle';
            if (file_exists('classes/' . $className . '.php')) {
                $className = 'Vehicles\\' . ucfirst($vehicle_type). '\\' . $className;
                $auto = new $className('Ford', 25, 50, 5, 1001);
                
                $this->data = $auto->getInfo();

                View::renderOutput($this->data);
            } else
                throw new Exception('You cannot create this type of vehicle!<br />');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), '<br />';
        }    
    }
}