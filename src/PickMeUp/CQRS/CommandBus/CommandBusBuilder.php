<?php

namespace PickMeUp\CQRS\CommandBus;

use PickMeUp\CQRS\CommandHandler\CommandHandler;

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
     * @return $this
     */
    public function add(CommandHandler $handler)
    {
        if (!in_array($handler, $this->handlers, true)) {
            $this->handlers[] = $handler;
        }

        return $this;
    }
}