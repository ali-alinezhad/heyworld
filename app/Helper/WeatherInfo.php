<?php

namespace App\Helper;

use App\Repository\Constant;

class WeatherInfo
{
    /**
     * @param string $city
     *
     * @return array
     */
    public function getWeatherInfo(string $city): array
    {
        $url = sprintf(
            Constant::URL,
            $city,
            Constant::API_ID
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'X-RapidAPI-Host: kvstore.p.rapidapi.com',
            'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'Content-Type: application/json'
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}