<?php

namespace PickMeUp\App\CommandBus;

use PickMeUp\App\Command\Command;
use PickMeUp\App\Handler\CommandHandler;

class CommandBus
{
    /**
     * @var CommandHandler[]
     */
    protected $handlers = [];

    /**
     * CommandBus constructor.
     * @param array $handlers
     */
    public function __construct(array $handlers = [])
    {
        foreach ($handlers as $handler) {
            $this->add($handler);
        }
    }

    /**
     * @param CommandHandler $handler
     */
    private function add(CommandHandler $handler)
    {
        if (in_array($handler, $this->handlers, true)) {
            return;
        }

        $this->handlers[] = $handler;
    }

    /**
     * @return CommandHandler[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * @param Command $command
     * @throws CommandHandlerNotFoundException
     */
    public function handle(Command $command)
    {
        $handler = $this->getHandlerForCommand($command);
        if (!$handler) {
            throw new CommandHandlerNotFoundException(Command::class);
        }

        $handler->handle($command);
    }

    /**
     * @param Command $command
     * @return null|CommandHandler
     */
    private function getHandlerForCommand(Command $command)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supportsCommand($command)) {
                return $handler;
            }
        }

        return null;
    }
}