<?php

namespace App;

use App\Helper\FileReader;
use App\Helper\Helper;
use App\Helper\WeatherInfo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\NoConfigurationException;

class Router
{
    public function __invoke(RouteCollection $routes)
    {
        $fileReader  = new FileReader();
        $weatherInfo = new WeatherInfo();
        $helper      = new Helper($fileReader, $weatherInfo);
        $context     = new RequestContext();
        $context->fromRequest(Request::createFromGlobals());

        // Routing can match routes with incoming requests
        $matcher = new UrlMatcher($routes, $context);
        try {
            $matcher = $matcher->match($_SERVER['REQUEST_URI']);

            // Cast params to int if numeric
            array_walk($matcher, function (&$param) {
                if (is_numeric($param)) {
                    $param = (int) $param;
                }
            });

            // Issue #2: Fix Non-static method ... should not be called statically
            $className     = '\\App\\Controllers\\' . $matcher['controller'];
            $classInstance = new $className();

            // Add routes as paramaters to the next class
            $params = array_merge(array_slice($matcher, 2, -1), array('routes' => $routes, 'helper' => $helper));

            call_user_func_array(array($classInstance, $matcher['method']), $params);

        }
        catch (MethodNotAllowedException $e) {
            echo 'Route method is not allowed.';
        }
        catch (ResourceNotFoundException $e) {
            echo 'Route does not exists.';
        }
    }
}

// Invoke
$router = new Router();
$router($routes);
