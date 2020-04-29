<?php

namespace App;

class Car
{
    protected $data = [];

    public function __construct($id)
    {
        $this->car_id 		= $id;
        $this->make 		= 'Unknown';
        $this->mileage 		= 'Not registered';
        $this->price 		= 'Unknown';
        $this->description 	= 'Not available';
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return (isset($this->data[$name])) ? $this->data[$name] : FALSE;
    }

    public function getPrice()
    {
	    return (is_numeric($this->price)) ? '$' . number_format($this->price, 2) : $this->price;
    }

    public function getMileage()
    {
        return (is_numeric($this->mileage)) ? number_format($this->mileage) : $this->mileage;
    }

    public function __toString()
    {
        $output =  'Car id:' . $this->car_id . '<br>';
        $output .= 'Make: ' . $this->make . '<br>';
        $output .= 'Mileage: ' . $this->getMileage() . '<br>';
        $output .= 'Price: ' . $this->getPrice() . '<br>';
        $output .= 'Description: ' . $this->description;
        return $output;
    }
} 
