<?php

namespace Tests\PickMeUp\App\Model;

use PickMeUp\App\Model\RideId;

class RideIdTest extends \PHPUnit_Framework_TestCase
{
    public function test_user_stores_own_unique_id()
    {
        $uuid = uniqid('RideId1', true);
        $userId = new RideId($uuid);
        static::assertSame($uuid, $userId->getUuid());
    }
}
