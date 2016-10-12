<?php

namespace Tests\PickMeUp\App\WriteStorage\Result;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;
use PickMeUp\App\WriteStorage\Result\RideResult;

class RideResultTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_ride_id()
    {
        $rideId = new RideId('Unique');
        $rideResult = new RideResult();
        $rideResult->setRideId($rideId);
        self::assertSame($rideId, $rideResult->getRideId());
    }

    public function test_it_stores_requester_id()
    {
        $requesterId = new UserId('Unique');
        $rideResult = new RideResult();
        $rideResult->setRequesterId($requesterId);
        self::assertSame($requesterId, $rideResult->getRequesterId());
    }

    public function test_it_stores_coordinates_start()
    {
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $rideResult = new RideResult();
        $rideResult->setCoordinatesStart($coordinates);
        self::assertSame($coordinates, $rideResult->getCoordinatesStart());
    }

    public function test_it_stores_coordinates_end()
    {
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $rideResult = new RideResult();
        $rideResult->setCoordinatesEnd($coordinates);
        self::assertSame($coordinates, $rideResult->getCoordinatesEnd());
    }

    public function test_it_stores_expiration_minutes()
    {
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();
        $rideResult = new RideResult();
        $rideResult->setExpirationMinutes($expirationMinutes);
        self::assertSame($expirationMinutes, $rideResult->getExpirationMinutes());
    }

    public function test_it_stores_created_at()
    {
        $createdAt = new \DateTime();
        $rideResult = new RideResult();
        $rideResult->setCreatedAt($createdAt);
        self::assertSame($createdAt, $rideResult->getCreatedAt());
    }

    public function test_it_stores_status()
    {
        $status = Ride::STATUS_PENDING;
        $rideResult = new RideResult();
        $rideResult->setStatus($status);
        self::assertSame($status, $rideResult->getStatus());
    }
}