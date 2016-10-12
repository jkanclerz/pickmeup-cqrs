<?php

namespace Tests\PickMeUp\App\Model;

use PickMeUp\App\Model\UserId;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    public function test_user_stores_own_unique_id()
    {
        $uuid = uniqid('PickMeUp!', true);
        $user = new UserId($uuid);
        static::assertSame($uuid, $user->getUuid());
    }
}
