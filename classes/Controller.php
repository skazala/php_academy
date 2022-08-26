<?php

use Nette\Http\Request;

class Controller
{
    protected $data = array();

    public function processRequest(Request $httpRequest)
    {    
        $vehicle_type = $httpRequest->getQuery('fuel');
        
        $className = ucfirst($vehicle_type) . 'Vehicle';
        if (file_exists('classes/' . $className . '.php')) {
            $className = 'Vehicles\\' . ucfirst($vehicle_type). '\\' . $className;
            $auto = new $className('Ford', 25, 50, 5, 1001);                
            $this->data = $auto->getInfo();    
        } else
            $this->data['error'] = 'You cannot create this type of vehicle!<br />';
            
        echo (View::renderOutput($this->data));
    }
}