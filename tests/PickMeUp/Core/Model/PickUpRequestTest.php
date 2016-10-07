<?php

namespace Tests\PickMeUp\Core\Model;

use PickMeUp\Core\Model\Geolocation\Coordinates;
use PickMeUp\Core\Model\PickUpRequest;
use PickMeUp\Core\Model\User;

class PickUpRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider invalidExpirationMinutesProvider
     * @expectedException \InvalidArgumentException
     */
    public function test_it_cannot_be_initialized_when_invalid_expiration_minutes_is_passed($invalidExpirationMinutesValue)
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();

        new PickUpRequest($user, $coordinates, $createdAt, $invalidExpirationMinutesValue);
    }

    /**
     * @return array
     */
    public function invalidExpirationMinutesProvider()
    {
        return [
            ["0"],
            [new \StdClass()],
            [new \DateTime()],
            [-10],
            [-0.01],
        ];
    }

    public function test_it_stores_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, 0);
        static::assertSame($user, $pickUpRequest->getUser());
    }

    public function test_it_stores_coordinates_of_user()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, 0);
        static::assertSame($coordinates, $pickUpRequest->getCoordinates());
    }

    public function test_it_has_created_at_date()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, 0);
        static::assertSame($createdAt, $pickUpRequest->getCreatedAt());
    }

    public function test_it_has_expiration_minutes()
    {
        $user = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $coordinates = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $createdAt = new \DateTime();

        $pickUpRequest = new PickUpRequest($user, $coordinates, $createdAt, 0);
        static::assertSame(0, $pickUpRequest->getExpirationMinutes());
    }
}
