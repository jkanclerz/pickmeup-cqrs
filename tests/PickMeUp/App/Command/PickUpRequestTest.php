<?php

namespace Tests\PickMeUp\App\Command;

use PickMeUp\App\Command\PickUpRequest;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\User;

class PickUpRequestTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($user, $pickUpRequest->getUser());
    }

    public function test_it_stores_start_coordinates_of_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesStart, $pickUpRequest->getCoordinatesStart());
    }

    public function test_it_stores_end_coordinates_of_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($coordinatesEnd, $pickUpRequest->getCoordinatesEnd());
    }

    public function test_it_has_created_at_date()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($createdAt, $pickUpRequest->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinatesStart = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $coordinatesEnd = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinatesStart, $coordinatesEnd, $createdAt, $expirationMinutes);
        static::assertSame($expirationMinutes, $pickUpRequest->getExpirationMinutes());
    }
}
