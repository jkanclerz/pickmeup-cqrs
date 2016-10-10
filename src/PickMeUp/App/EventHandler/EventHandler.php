<?php

namespace PickMeUp\App\EventHandler;

use PickMeUp\App\Event\Event;

interface EventHandler
{
    public function handle(Event $event);
}