<?php

namespace Demo\Api;

use Silex;

class Application extends Silex\Application
{
    public function __construct()
    {
        parent::__construct();
        $this->mount('/service', new Controller\ServiceController());
    }
}
