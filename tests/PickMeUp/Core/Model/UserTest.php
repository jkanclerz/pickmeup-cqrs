<?php

namespace Tests\PickMeUp\Core\Model;

use PickMeUp\Core\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_user_stores_own_unique_id()
    {
        $uuid = uniqid('PickMeUp!', true);
        $user = new User($uuid);
        static::assertSame($uuid, $user->getUuid());
    }
}
