<?php

namespace PickMeUp\App\EventBus;

use PickMeUp\App\Event\Event;
use PickMeUp\App\EventHandler\EventHandler;

class EventBus
{
    /**
     * @var array
     */
    protected $eventHandlerMap = [];

    /**
     * EventBus constructor.
     * @param array $eventHandlerMap
     * @throws \PickMeUp\App\EventBus\MultipleSameEventHandlerAttachAttemptException
     */
    public function __construct(array $eventHandlerMap = [])
    {
        foreach ($eventHandlerMap as $eventClass => $handlers) {
            foreach ($handlers as $handler) {
                $this->attach($eventClass, $handler);
            }
        }
    }

    /**
     * @return array
     */
    public function getEventHandlerMap()
    {
        return $this->eventHandlerMap;
    }

    /**
     * @param $eventClass
     * @param EventHandler $handler
     * @throws MultipleSameEventHandlerAttachAttemptException
     */
    private function attach($eventClass, EventHandler $handler)
    {
        if (isset($this->eventHandlerMap[$eventClass]) && in_array($handler, $this->eventHandlerMap[$eventClass], true)) {
            throw new MultipleSameEventHandlerAttachAttemptException();
        }

        $this->eventHandlerMap[$eventClass][] = $handler;
    }
}