<?php

namespace PickMeUp\App\EventBus;

use PickMeUp\App\EventHandler\EventHandler;

class EventBusBuilder
{
    /** @var array */
    protected $eventHandlerMap = [];

    /**
     * @return EventBus
     */
    public function build()
    {
        return new EventBus($this->eventHandlerMap);
    }

    /**
     * @param $eventName
     * @param EventHandler $handler
     * @return $this
     * @throws MultipleSameEventHandlerAttachAttemptException
     */
    public function attach($eventName, EventHandler $handler)
    {
        if (isset($this->eventHandlerMap[$eventName]) && in_array($handler, $this->eventHandlerMap[$eventName], true)) {
            throw new MultipleSameEventHandlerAttachAttemptException();
        }

        $this->eventHandlerMap[$eventName][] = $handler;
        return $this;
    }
}