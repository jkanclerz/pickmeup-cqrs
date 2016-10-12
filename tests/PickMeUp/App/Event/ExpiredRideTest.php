<?php

namespace Tests\PickMeUp\App\Event;

use PickMeUp\App\Event\CreatedRideRequest;
use PickMeUp\App\Event\ExpiredRide;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;

class ExpiredRideTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_event()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        self::assertInstanceOf('\PickMeUp\CQRS\Event\Event', new ExpiredRide($rideId));
    }

    public function test_it_stores_ride_id()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        self::assertSame($rideId, (new ExpiredRide($rideId))->getRideId());
    }

    public function test_it_has_name()
    {
        self::assertSame('expired_ride', ExpiredRide::getName());
    }
}