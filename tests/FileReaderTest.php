<?php

use App\Helper\FileReader;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    private FileReader $fileReader;


    protected function setUp(): void
    {
        parent::setUp();
        $this->fileReader = new FileReader();
    }


    public function testGetCityNameWhenIsNull(): void
    {
        static::assertNull($this->fileReader->getCityName('2.2', '5.5', './files/cities.dat'));
    }


    public function testGetCityName(): void
    {
        static::assertEquals('Berlin,DE', $this->fileReader->getCityName('13.4251364', '52.5075419', './files/cities.dat'));
    }
}