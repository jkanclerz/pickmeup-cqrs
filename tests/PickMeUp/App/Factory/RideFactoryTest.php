<?php

namespace Tests\PickMeUp\App\Factory;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\UserId;

class RideFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_produces_ride_from_ride_request_command()
    {
        $rideRequestCommand = $this->getRideRequestCommandMock();
        $factory = new RideFactory();
        static::assertInstanceOf(Ride::class, $factory->createFromRideRequestCommand($rideRequestCommand));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRideRequestCommandMock()
    {
        $rideRequestCommand = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();
        $rideRequestCommand->method('getUserId')->willReturn($this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock());
        $rideRequestCommand->method('getCoordinatesStart')->willReturn($this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock());
        $rideRequestCommand->method('getCoordinatesEnd')->willReturn($this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock());
        $rideRequestCommand->method('getCreatedAt')->willReturn($this->getMockBuilder(\DateTime::class)->disableOriginalConstructor()->getMock());
        $rideRequestCommand->method('getExpirationMinutes')->willReturn($this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock());

        return $rideRequestCommand;
    }
}