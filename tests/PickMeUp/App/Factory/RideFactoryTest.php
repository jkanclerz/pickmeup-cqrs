<?php

namespace Tests\PickMeUp\App\Factory;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\User;

class RideFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_produces_ride_from_pick_up_request_command()
    {
        $pickUpRequestCommand = $this->getPickUpRequestCommandMock();
        $factory = new RideFactory();
        static::assertInstanceOf(Ride::class, $factory->createFromPickUpRequestCommand($pickUpRequestCommand));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getPickUpRequestCommandMock()
    {
        $pickUpRequestCommand = $this->getMockBuilder(PickUpRequestCommand::class)->disableOriginalConstructor()->getMock();
        $pickUpRequestCommand->method('getUser')->willReturn($this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock());
        $pickUpRequestCommand->method('getCoordinatesStart')->willReturn($this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock());
        $pickUpRequestCommand->method('getCoordinatesEnd')->willReturn($this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock());
        $pickUpRequestCommand->method('getCreatedAt')->willReturn($this->getMockBuilder(\DateTime::class)->disableOriginalConstructor()->getMock());
        $pickUpRequestCommand->method('getExpirationMinutes')->willReturn($this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock());

        return $pickUpRequestCommand;
    }
}