<?php

namespace tests\PickMeUp\App\Model;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\User;

class RideTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_requester()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $ride = new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($requester, $ride->getRequester());
    }

    public function test_it_stores_start_coordinates_of_user()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $ride = new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesStart, $ride->getCoordinatesStart());
    }

    public function test_it_stores_end_coordinates_of_user()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $ride = new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesEnd, $ride->getCoordinatesEnd());
    }

    public function test_it_has_created_at_date()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $ride = new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($createdAt, $ride->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $ride = new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($expirationMinutes, $ride->getExpirationMinutes());
    }

    public function test_it_has_status_pending_after_initialization()
    {
        $ride = $this->getRideWithValidMockData();
        self::assertSame(Ride::STATUS_PENDING, $ride->getStatus());
    }

    /**
     * @return Ride
     */
    private function getRideWithValidMockData()
    {
        $requester = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        return new Ride($requester, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
    }
}