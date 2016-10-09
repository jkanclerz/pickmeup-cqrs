<?php

namespace PickMeUp\App\CommandBus;

use PickMeUp\App\Handler\CommandHandler;

class CommandBusBuilder
{
    /**
     * @var CommandHandler[]
     */
    protected $handlers = [];

    /**
     * @return CommandBus
     */
    public function build()
    {
        return new CommandBus($this->handlers);
    }

    /**
     * @param CommandHandler $handler
     */
    public function add(CommandHandler $handler)
    {
        if (in_array($handler, $this->handlers, true)) {
            return;
        }

        $this->handlers[] = $handler;
    }
}