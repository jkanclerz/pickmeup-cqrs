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
     * @param $eventClass
     * @param EventHandler $handler
     * @return $this
     * @throws MultipleSameEventHandlerAttachAttemptException
     */
    public function attach($eventClass, EventHandler $handler)
    {
        if (isset($this->eventHandlerMap[$eventClass]) && in_array($handler, $this->eventHandlerMap[$eventClass], true)) {
            throw new MultipleSameEventHandlerAttachAttemptException();
        }

        $this->eventHandlerMap[$eventClass][] = $handler;
        return $this;
    }
}