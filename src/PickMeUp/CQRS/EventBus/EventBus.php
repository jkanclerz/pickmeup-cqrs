<?php

namespace PickMeUp\CQRS\EventBus;

use PickMeUp\CQRS\Event\Event;
use PickMeUp\CQRS\EventHandler\EventHandler;

class EventBus
{
    /**
     * @var array
     */
    protected $eventHandlerMap = [];

    /**
     * EventBus constructor.
     * @param array $eventHandlerMap
     * @throws \PickMeUp\CQRS\EventBus\MultipleSameEventHandlerAttachAttemptException
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
     * @param $eventName
     * @param EventHandler $handler
     * @throws MultipleSameEventHandlerAttachAttemptException
     */
    private function attach($eventName, EventHandler $handler)
    {
        if (!isset($this->eventHandlerMap[$eventName])) {
            $this->eventHandlerMap[$eventName] = [];
        }

        if (in_array($handler, $this->eventHandlerMap[$eventName], true)) {
            throw new MultipleSameEventHandlerAttachAttemptException();
        }

        $this->eventHandlerMap[$eventName][] = $handler;
    }

    /**
     * @param Event $event
     */
    public function publish(Event $event)
    {
        /** @var EventHandler[] $handlers */
        $handlers = isset($this->eventHandlerMap[$event->getName()]) ? $this->eventHandlerMap[$event->getName()] : [];
        foreach ($handlers as $handler) {
            $handler->handle($event);
        }
    }
}