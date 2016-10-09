<?php

namespace Tests\PickMeUp\App\CommandBus;

use PickMeUp\App\CommandBus\CommandBus;
use PickMeUp\App\CommandBus\CommandBusBuilder;

class CommandBusBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_builds_command_bus()
    {
        $builder = new CommandBusBuilder();
        self::assertInstanceOf(CommandBus::class, $builder->build());
    }

    public function test_it_stores_command_handlers_that_are_injected_into_command_bus()
    {
        $handler = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $handler2 = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();

        $builder = new CommandBusBuilder();
        $builder->add($handler);
        $builder->add($handler2);
        $commandBus = $builder->build();

        static::assertSame([$handler, $handler2], $commandBus->getHandlers());
    }
}