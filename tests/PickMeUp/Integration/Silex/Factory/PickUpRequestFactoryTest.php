<?php

namespace Tests\PickMeUp\Integration\Silex\Factory;

use PickMeUp\App\Command\PickUpRequest;
use PickMeUp\Integration\Silex\Factory\PickUpRequestFactory;

class PickUpRequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidParametersSet
     */
    public function test_when_any_input_parameter_doesnt_pass_value_object_validation(
        $userUuid,
        $expirationMinutes,
        $latitudeStart,
        $longitudeStart,
        $latitudeEnd,
        $longitudeEnd

    ) {
        $factory = new PickUpRequestFactory();
        $factory->create($userUuid, $expirationMinutes, $latitudeStart, $longitudeStart, $latitudeEnd, $longitudeEnd);
    }

    public function test_it_creates_pick_up_request_for_valid_parameters()
    {
        $factory = new PickUpRequestFactory();
        $pickUpRequest = $factory->create('user', 5, 49.001, 15.1332, 48.998801, 14.12442);
        $this->assertInstanceOf(PickUpRequest::class, $pickUpRequest);
    }

    /**
     * @return array
     */
    public function invalidParametersSet()
    {
        return [
            ['user', -10, 0, 0, 0, 0],
            ['user', 10, -91, 0, 0, 0],
            ['user', 10,  91, 0, 0, 0],
            ['user', 10,  0, -181, 0, 0],
            ['user', 10,  0,  181, 0, 0],
            ['user', 10, 0, 0, -91, 0],
            ['user', 10, 0, 0, 91, 0],
            ['user', 10, 0, 0, 0, -181],
            ['user', 10, 0, 0, 0, 181],
        ];
    }
}