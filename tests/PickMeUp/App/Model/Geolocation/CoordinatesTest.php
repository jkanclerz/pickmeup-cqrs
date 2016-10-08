<?php

namespace Tests\PickMeUp\App\Model\Geolocation;

use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Geolocation\Latitude;
use PickMeUp\App\Model\Geolocation\Longitude;

class CoordinatesTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_latitude()
    {
        $latitude = new Latitude(45);
        $longitude = new Longitude(45);

        $coordinates = new Coordinates($latitude, $longitude);
        static::assertSame($latitude, $coordinates->getLatitude());
    }

    public function test_it_stores_longitude()
    {
        $latitude = new Latitude(45);
        $longitude = new Longitude(45);

        $coordinates = new Coordinates($latitude, $longitude);
        static::assertSame($longitude, $coordinates->getLongitude());
    }
}