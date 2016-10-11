<?php

namespace PickMeUp\CQRS\CommandHandler;

use PickMeUp\CQRS\Command\Command;

interface CommandHandler
{
    /**
     * @param Command $command
     * @return void
     */
    public function handle(Command $command);

    /**
     * @param Command $command
     * @return bool
     */
    public function supportsCommand(Command $command);
}