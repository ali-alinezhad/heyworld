<?php

use App\Helper\FileReader;
use App\Helper\Helper;
use App\Helper\WeatherInfo;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    private Helper $helper;

    /**
     * @var FileReader|\PHPUnit\Framework\MockObject\MockObject
     */
    private $fileReader;

    /**
     * @var WeatherInfo|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private $weatherInfo;


    protected function setUp(): void
    {
        parent::setUp();
        $this->fileReader  = $this->createMock(FileReader::class);
        $this->weatherInfo = $this->createMock(WeatherInfo::class);
        $this->helper      = new Helper($this->fileReader, $this->weatherInfo);
    }


    public function testGetCityNameWhenReturnNull(): void
    {
        static::assertNull($this->helper->getCityName('2.2', '9.99'));
    }


    public function testGetCityName(): void
    {
        $lon  = \uniqid('lon');
        $lat  = \uniqid('lat');
        $city = \uniqid('city');
        $this->fileReader->expects(static::once())
            ->method('getCityName')
            ->with($lon, $lat)
            ->willReturn($city);

        static::assertEquals($city, $this->helper->getCityName($lon, $lat));
    }


    public function testGetWeatherInfo(): void
    {
        $city     = \uniqid('city');
        $expected = [
            'coord'   => ['lon' => '2.2', 'lat' => '9.9'],
            'weather' => ['id' => 1],
            'name'    => 'Berlin'
        ];
        $this->weatherInfo->expects(static::once())
            ->method('getWeatherInfo')
            ->with($city)
            ->willReturn($expected);
        static::assertEquals($expected, $this->helper->getWeatherInfo($city));
    }


    public function testDisplayTable(): void
    {
        $info = [
            'coord'   => ['lon' => '2.2', 'lat' => '9.9'],
            'weather' => [
                [
                    "description" => "scattered clouds",
                    "icon"        => "03d"
                ]
            ],
            'name'    => 'Berlin',
            'sys'     => [
                'country' => 'DE'
            ],
            'main'    => [
                'temp_min' => 278.87,
                'temp_max' => 301.21,
            ]
        ];

        $expected = "
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
        <td>Berlin,DE</td>
        <td>5.72 C</td>
        <td>28.06 C</td>
        <td>4512.21 KM</td>
        <td>scattered clouds<img src='http://openweathermap.org/img/wn/03d.png'></td>
        </tr>
        </tbody>
        </table>
        ";

        static::assertEquals($expected, $this->helper->displayTable($info));
    }
}