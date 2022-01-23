<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/',
    array('controller' => 'DefaultController', 'method'=>'indexAction'), []));
$routes->add('showInfo', new Route(constant('URL_SUBFOLDER') . '/show/info',
    array('controller' => 'DefaultController', 'method'=>'showInfoAction'), []));
