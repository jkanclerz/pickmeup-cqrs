<?php

namespace PickMeUp\CQRS\EventHandler;

use PickMeUp\CQRS\Event\Event;

interface EventHandler
{
    public function handle(Event $event);
}