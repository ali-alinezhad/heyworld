<?php

namespace App\Helper;

use App\Repository\Constant;

class Helper
{
    private FileReader $fileReader;

    private WeatherInfo $weatherInfo;


    public function __construct(FileReader $fileReader, WeatherInfo $weatherInfo)
    {
        $this->fileReader  = $fileReader;
        $this->weatherInfo = $weatherInfo;
    }


    /**
     * @param string $longitude
     * @param string $latitude
     *
     * @return string|null
     */
    public function getCityName(string $longitude, string $latitude): ?string
    {
        return $this->fileReader->getCityName($longitude, $latitude, Constant::FILE);
    }


    /**
     * @param string $city
     *
     * @return array
     */
    public function getWeatherInfo(string $city): array
    {
        return $this->weatherInfo->getWeatherInfo($city);
    }


    /**
     * @param array $info
     *
     * @return string
     */
    public function displayTable(array $info): string
    {
        $distance = $this->getDistance(
            $info['coord']["lat"],
            $info['coord']["lon"]
        );

        $weather = reset($info['weather']);

        return "
        <table class='table'>
        <thead>
        <tr>
            <th>City name</th>
            <th>Min temperature</th>
            <th>Max temperature</th>
            <th>Distance to the entered coordinates</th>
            <th> Weather description</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        <td>" . $info['name'] . ',' . $info['sys']['country'] . "</td>
        <td>" . $this->getMinTempOnCelsius((float) $info['main']['temp_min']) . " C</td>
        <td>" . $this->getMaxTempOnCelsius((float) $info['main']['temp_max']) . " C</td>
        <td>" . $distance . " KM</td>
        <td>" . $weather['description'] . "<img src='" . Constant::ICON_URL . $weather['icon'] . ".png'></td>
        </tr>
        </tbody>
        </table>
        ";
    }


    /**
     * @param float $latitudeTo
     * @param float $longitudeTo
     *
     * @return float
     */
    private function getDistance(
        float $latitudeTo,
        float $longitudeTo
    ): float
    {
        $latFrom = deg2rad(Constant::LAT_FRANKFURT);
        $lonFrom = deg2rad(Constant::LON_FRANKFURT);
        $latTo   = deg2rad($latitudeTo);
        $lonTo   = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(
                sqrt(
                    pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)
                )
            );
        return number_format((float) $angle * 6371, 2, '.', '');
    }


    /**
     * @param float $tempOnKelvin
     *
     * @return float
     */
    private function getMinTempOnCelsius(float $tempOnKelvin): float
    {
        return $tempOnKelvin - 273.15;
    }


    /**
     * @param float $tempOnKelvin
     *
     * @return float
     */
    private function getMaxTempOnCelsius(float $tempOnKelvin): float
    {
        return $tempOnKelvin - 273.15;
    }
}