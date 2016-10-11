<?php

namespace Tests\PickMeUp\CQRS\Handler;

use PickMeUp\CQRS\CommandHandler\UnsupportedCommandException;

class UnsupportedCommandExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_exception()
    {
        $unsupportedCommandException = new UnsupportedCommandException();
        self::assertInstanceOf('\Exception', $unsupportedCommandException);
    }
}