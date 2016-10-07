<?php

namespace Tests\PickMeUp\Core\Model;

use PickMeUp\Core\Model\ExpirationMinutes;
use PickMeUp\Core\Model\Geolocation\Coordinates;
use PickMeUp\Core\Model\PickUpRequest;
use PickMeUp\Core\Model\User;

class PickUpRequestTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, $expirationMinutes);
        static::assertSame($user, $pickUpRequest->getUser());
    }

    public function test_it_stores_coordinates_of_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, $expirationMinutes);
        static::assertSame($coordinates, $pickUpRequest->getCoordinates());
    }

    public function test_it_has_created_at_date()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, $expirationMinutes);
        static::assertSame($createdAt, $pickUpRequest->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();
        $expirationMinutes = $this->getMockBuilder(ExpirationMinutes::class)->disableOriginalConstructor()->getMock();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, $expirationMinutes);
        static::assertSame($expirationMinutes, $pickUpRequest->getExpirationMinutes());
    }
}
