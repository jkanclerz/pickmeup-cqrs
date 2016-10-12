<?php

namespace Tests\PickMeUp\App\Command;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;
use PickMeUp\CQRS\Command\Command;

class RideRequestCommandTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instance_of_command()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertInstanceOf(Command::class, $rideRequest);
    }

    public function test_it_stores_ride_id()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($rideId, $rideRequest->getRideId());
    }

    public function test_it_stores_requester_id()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($requesterId, $rideRequest->getRequesterId());
    }

    public function test_it_stores_start_coordinates_of_requesterId()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesStart, $rideRequest->getCoordinatesStart());
    }

    public function test_it_stores_end_coordinates_of_requesterId()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesEnd, $rideRequest->getCoordinatesEnd());
    }

    public function test_it_has_created_at_date()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($createdAt, $rideRequest->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $rideRequest = new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($expirationMinutes, $rideRequest->getExpirationMinutes());
    }
}
