<?php

namespace App\Helper;


class FileReader
{
    /**
     * @param string $longitude
     * @param string $latitude
     * @param string $file
     *
     * @return string|null
     */
    public function getCityName(string $longitude, string $latitude, string $file): ?string
    {
        $lines = file($file);

        foreach ($lines as $line) {
            if (strpos($line, $longitude) && strpos($line, $latitude)) {
                $line = explode(" ", $line);
                return $line[2] . ',' . $line[0];
            }
        }

        return null;
    }
}