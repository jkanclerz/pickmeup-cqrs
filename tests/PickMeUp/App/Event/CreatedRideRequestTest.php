<?php

namespace Tests\PickMeUp\App\Event;

use PickMeUp\App\Event\CreatedRideRequest;
use PickMeUp\App\Model\Ride;

class CreatedRideRequestTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_event()
    {
        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();
        self::assertInstanceOf('\PickMeUp\CQRS\Event\Event', new CreatedRideRequest($ride));
    }

    public function test_it_stores_ride_model()
    {
        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();
        self::assertSame($ride, (new CreatedRideRequest($ride))->getRide());
    }

    public function test_it_has_name()
    {
        self::assertSame('created_ride_request', CreatedRideRequest::getName());
    }
}