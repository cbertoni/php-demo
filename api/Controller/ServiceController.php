<?php

namespace Demo\Api\Controller;

use Exception;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Demo\Hello\HelloClass;

class ServiceController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers
            ->get('/hello/{name}', [$this, 'getHello'])
            ->bind('service.hello');

        return $controllers;
    }

    public function getHello($name)
    {
        $hello_class = new HelloClass($name);
        return new JsonResponse(
            [
                'data' => $hello_class->sayHello()
            ], 
            200
        );
    }
}
