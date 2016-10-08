<?php

namespace Tests\PickMeUp\App\Model\Geolocation;

use PickMeUp\App\Model\Geolocation\Longitude;

class LongitudeTest extends \PHPUnit_Framework_TestCase
{
    public function test_class()
    {
        static::assertSame('PickMeUp\App\Model\Geolocation\Longitude', Longitude::class);
    }

    /**
     * @dataProvider validLongitudeValues
     */
    public function test_it_stores_valid_longitude_value_in_range_minus_90_to_plus_90($value)
    {
        $longitude = new Longitude($value);
        static::assertSame($value, $longitude->getValue());
    }

    /**
     * @dataProvider invalidLongitudeValues
     * @expectedException \InvalidArgumentException
     */
    public function test_it_throws_exception_when_invalid_value_is_passed($value)
    {
        $longitude = new Longitude($value);
    }

    /**
     * @return array
     */
    public function validLongitudeValues()
    {
        return [
            [-180.0],
            [-89.1231212313],
            [-20.12312],
            [-10.0],
            [0.0],
            [0.12312312],
            [10.0112312],
            [180.0],
        ];
    }

    /**
     * @return array
     */
    public function invalidLongitudeValues()
    {
        return [
            [-180.1],
            [-180.00000000001],
            [-230.112312],
            [180.0123456789],
            [180.00000000001],
            [190.0],
        ];
    }
}