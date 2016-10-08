<?php

namespace Tests\PickMeUp\App\Model;

use PickMeUp\App\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_user_stores_own_unique_id()
    {
        $uuid = uniqid('PickMeUp!', true);
        $user = new User($uuid);
        static::assertSame($uuid, $user->getUuid());
    }
}
