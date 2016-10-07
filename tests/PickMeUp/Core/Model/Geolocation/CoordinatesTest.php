<?php

namespace Tests\PickMeUp\Core\Model\Geolocation;

use PickMeUp\Core\Model\Geolocation\Coordinates;
use PickMeUp\Core\Model\Geolocation\Latitude;
use PickMeUp\Core\Model\Geolocation\Longitude;

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