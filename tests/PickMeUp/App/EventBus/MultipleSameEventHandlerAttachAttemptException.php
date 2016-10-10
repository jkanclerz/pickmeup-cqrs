<?php

namespace Tests\PickMeUp\App\CommandBus;

use PickMeUp\App\EventBus\MultipleSameEventHandlerAttachAttemptException;

class MultipleSameEventHandlerAttachAttemptExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_exception()
    {
        $exception = new MultipleSameEventHandlerAttachAttemptException();
        self::assertInstanceOf('\Exception', $exception);
    }
}