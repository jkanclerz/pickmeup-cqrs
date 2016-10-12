<?php

namespace Tests\PickMeUp\Integration\Silex\Factory;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Model\RideId;
use PickMeUp\Integration\Silex\Factory\RideRequestCommandFactory;

class RideRequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidParametersSet
     */
    public function test_when_any_input_parameter_doesnt_pass_value_object_validation(
        $rideId,
        $userUuid,
        $expirationMinutes,
        $latitudeStart,
        $longitudeStart,
        $latitudeEnd,
        $longitudeEnd

    ) {
        $factory = new RideRequestCommandFactory();
        $factory->create($rideId, $userUuid, $expirationMinutes, $latitudeStart, $longitudeStart, $latitudeEnd, $longitudeEnd);
    }

    public function test_it_creates_ride_request_for_valid_parameters()
    {
        $factory = new RideRequestCommandFactory();
        $rideRequest = $factory->create(new RideId('rideId'), 'user', 5, 49.001, 15.1332, 48.998801, 14.12442);
        static::assertInstanceOf(RideRequestCommand::class, $rideRequest);
    }

    /**
     * @return array
     */
    public function invalidParametersSet()
    {
        return [
            [new RideId('rideId'), 'user', -10, 0, 0, 0, 0],
            [new RideId('rideId'), 'user', 10, -91, 0, 0, 0],
            [new RideId('rideId'), 'user', 10,  91, 0, 0, 0],
            [new RideId('rideId'), 'user', 10,  0, -181, 0, 0],
            [new RideId('rideId'), 'user', 10,  0,  181, 0, 0],
            [new RideId('rideId'), 'user', 10, 0, 0, -91, 0],
            [new RideId('rideId'), 'user', 10, 0, 0, 91, 0],
            [new RideId('rideId'), 'user', 10, 0, 0, 0, -181],
            [new RideId('rideId'), 'user', 10, 0, 0, 0, 181],
        ];
    }
}