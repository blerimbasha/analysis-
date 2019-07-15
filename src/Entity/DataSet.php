<?php


namespace App\Entity;


class DataSet
{
    public $methods = ['HEAD' => 0, 'POST' => 0, 'GET' => 0, 'INVALID' => 0];

    public function readMethod($method)
    {
        if (key_exists($method, $this->methods)) {
            $this->methods[$method] = $this->methods[$method] + 1;
        } else {
            $this->methods['INVALID'] ++;
        }

    }
}