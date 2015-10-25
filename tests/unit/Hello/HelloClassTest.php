<?php

namespace Demo\Hello;

use PHPUnit_Framework_TestCase;

class HelloClassTest extends PHPUnit_Framework_TestCase
{
    public function testSayHelloWithValidName()
    {
        $hello_class = new HelloClass("carli");
        $this->assertEquals("Hello carli!", $hello_class->sayHello());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage You have to provide a name
     */
    public function testSayHelloWithNullName()
    {
        new HelloClass(null);
    }
}