<?php

namespace Tests\PickMeUp\App\Handler;

use PickMeUp\App\Handler\UnsupportedCommandException;

class UnsupportedCommandExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_exception()
    {
        $unsupportedCommandException = new UnsupportedCommandException();
        self::assertInstanceOf('\Exception', $unsupportedCommandException);
    }
}