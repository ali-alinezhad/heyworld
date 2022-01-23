<?php

namespace App\Controllers;

use App\Helper\Helper;
use Symfony\Component\Routing\RouteCollection;


class DefaultController
{

    public function indexAction(RouteCollection $routes, Helper $helper)
    {
        require_once APP_ROOT . '/views/home.php';
    }


    public function showInfoAction(RouteCollection $routes, Helper $helper)
    {
        $longitude = $_POST['longitude'];
        $latitude  = $_POST['latitude'];

        $city = $helper->getCityName($longitude, $latitude);

        if (!$city) {
            echo "There is no city with these information";
        }

        $info = $helper->getWeatherInfo($city);

        if (!$info) {
            echo "There is no city with these information";
        }

        $table = $helper->displayTable($info);

        require_once APP_ROOT . '/views/info.php';
    }
}
