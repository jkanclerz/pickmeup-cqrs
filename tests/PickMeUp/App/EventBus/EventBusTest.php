<?php

namespace Tests\PickMeUp\App\EventBus;

use PickMeUp\App\Event\Event;
use PickMeUp\App\EventBus\EventBus;
use PickMeUp\App\EventHandler\EventHandler;

class EventBusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getValidEventHandlerMap
     */
    public function test_it_stores_event_handlers_attached_to_events($eventClass, $handlersCount)
    {
        $eventHandlerMap = [$eventClass => $this->getHandlerMocks($handlersCount)];
        $eventBus = new EventBus($eventHandlerMap);
        self::assertSame($eventHandlerMap, $eventBus->getEventHandlerMap());
    }

    public function getValidEventHandlerMap()
    {
        $eventClass = get_class($this->getMockBuilder('PickMeUp\App\Event\Event')->getMock());
        return [
            [$eventClass, 1],
            [$eventClass, 2],
            [$eventClass, 3],
        ];

    }

    /**
     * @expectedException \PickMeUp\App\EventBus\MultipleSameEventHandlerAttachAttemptException
     */
    public function test_it_allows_attach_unique_eventhandlers_to_specific_event()
    {
        $event = $this->getMockBuilder('PickMeUp\App\Event\Event')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $eventHandlerMap = [get_class($event) => [$handler, $handler]];
        new EventBus($eventHandlerMap);
    }

    /**
     * @param $handlersCount
     * @return array
     */
    private function getHandlerMocks($handlersCount)
    {
        $handlers = [];
        for ($i = 1; $i <= $handlersCount; $i++) {
            $handlers[] = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        }
        return $handlers;
    }
}
