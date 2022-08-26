<?php

class View
{
    public static function renderOutput($data)
    {        
        if (isset($data['error']))
            return $data['error'];
        require 'views/vehicletable.phtml';
    }
}