<?php

namespace Demo\Hello;

use InvalidArgumentException;

class HelloClass
{
    private $name;

    public function __construct($name)
    {
        if($name == null) {
            throw new InvalidArgumentException('You have to provide a name');
        }
        $this->name = $name;
    }

    public function sayHello()
    {
        return sprintf("Hello %s!", $this->name);
    }
}
