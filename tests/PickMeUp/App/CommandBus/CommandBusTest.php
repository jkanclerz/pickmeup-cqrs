<?php

namespace Tests\PickMeUp\App\CommandBus;

use PickMeUp\App\CommandBus\CommandBus;

class CommandBusTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_command_handlers_added_through_construction()
    {
        $handler = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $commandBus = new CommandBus([$handler]);

        static::assertSame([$handler], $commandBus->getHandlers());
    }

    public function test_it_finds_command_handler_for_command_to_handle()
    {
        $command = $this->getMockBuilder('PickMeUp\App\Command\Command')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $handler->method('supportsCommand')->with($command)->willReturn(false);
        $handler2 = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $handler2->method('supportsCommand')->with($command)->willReturn(true);
        $handler2->expects(self::once())->method('handle')->with($command);
        $commandBus = new CommandBus([$handler, $handler2]);
        $commandBus->handle($command);
    }

    /**
     * @expectedException \PickMeUp\App\CommandBus\CommandHandlerNotFoundException
     */
    public function test_it_throws_exception_when_cannot_find_handler_for_command()
    {
        $command = $this->getMockBuilder('PickMeUp\App\Command\Command')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $handler->method('supportsCommand')->with($command)->willReturn(false);
        $handler2 = $this->getMockBuilder('PickMeUp\App\Handler\CommandHandler')->getMock();
        $handler2->method('supportsCommand')->with($command)->willReturn(false);
        $commandBus = new CommandBus([$handler, $handler2]);
        $commandBus->handle($command);
    }
}