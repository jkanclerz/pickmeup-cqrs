<?php

namespace Tests\PickMeUp\App\CommandBus;

use PickMeUp\App\CommandBus\CommandHandlerNotFoundException;

class CommandHandlerNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_is_exception()
    {
        $commandHandlerNotFoundException = new CommandHandlerNotFoundException();
        self::assertInstanceOf('\Exception', $commandHandlerNotFoundException);
    }
}