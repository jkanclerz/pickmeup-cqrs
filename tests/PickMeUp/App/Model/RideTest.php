<?php

namespace tests\PickMeUp\App\Model;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;
use PickMeUp\App\WriteStorage\Result\RideResult;

class RideTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_can_be_reproduced_using_ride_result()
    {
        static::assertInstanceOf(Ride::class, Ride::createFromRideResult(new RideResult()));
    }

    public function test_it_stores_ride_id()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $result = new RideResult();
        $result->setRideId($rideId);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($rideId, $ride->getRideId());
    }

    public function test_it_stores_requester_id()
    {
        $requesterId = $this->getMockBuilder(UserId::class)->disableOriginalConstructor()->getMock();
        $result = new RideResult();
        $result->setRequesterId($requesterId);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($requesterId, $ride->getRequesterId());
    }

    public function test_it_stores_start_coordinates_of_user()
    {
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $result = new RideResult();
        $result->setCoordinatesStart($coordinatesStart);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($coordinatesStart, $ride->getCoordinatesStart());
    }

    public function test_it_stores_end_coordinates_of_user()
    {
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $result = new RideResult();
        $result->setCoordinatesEnd($coordinatesEnd);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($coordinatesEnd, $ride->getCoordinatesEnd());
    }

    public function test_it_has_created_at_date()
    {
        $createdAt = new \DateTime();
        $result = new RideResult();
        $result->setCreatedAt($createdAt);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($createdAt, $ride->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();
        $result = new RideResult();
        $result->setExpirationMinutes($expirationMinutes);
        $ride = Ride::createFromRideResult($result);
        static::assertSame($expirationMinutes, $ride->getExpirationMinutes());
    }

    public function test_it_stores_status()
    {
        $result = new RideResult();
        $result->setStatus(Ride::STATUS_PENDING);
        $ride = Ride::createFromRideResult($result);
        static::assertSame(Ride::STATUS_PENDING, $ride->getStatus());
    }
}