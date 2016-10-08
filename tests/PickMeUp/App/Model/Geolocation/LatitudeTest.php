<?php

namespace Tests\PickMeUp\App\Model\Geolocation;

use PickMeUp\App\Model\Geolocation\Latitude;

class LatitudeTest extends \PHPUnit_Framework_TestCase
{
    public function test_class()
    {
        static::assertSame('PickMeUp\App\Model\Geolocation\Latitude', Latitude::class);
    }

    /**
     * @dataProvider validLatitudeValues
     */
    public function test_it_stores_valid_latitude_value_in_range_minus_90_to_plus_90($value)
    {
        $latitude = new Latitude($value);
        static::assertSame($value, $latitude->getValue());
    }

    /**
     * @dataProvider invalidLatitudeValues
     * @expectedException \InvalidArgumentException
     */
    public function test_it_throws_exception_when_invalid_value_is_passed($value)
    {
        $latitude = new Latitude($value);
    }

    public function validLatitudeValues()
    {
        return [
            [-90.0],
            [-89.1231212313],
            [-20.12312],
            [-10.0],
            [0.0],
            [0.12312312],
            [10.0112312],
            [90.0]
        ];
    }

    public function invalidLatitudeValues()
    {
        return [
            [-90.1],
            [-100.0],
            [-230.112312],
            [90.00000000001],
            [190.0],
            [100.0123456789]
        ];
    }
}