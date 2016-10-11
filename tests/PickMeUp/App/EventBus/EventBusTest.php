<?php

namespace Tests\PickMeUp\App\EventBus;

use PickMeUp\App\Event\Event;
use PickMeUp\App\EventBus\EventBus;
use PickMeUp\App\EventBus\EventBusBuilder;
use PickMeUp\App\EventHandler\EventHandler;

class EventBusTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_event_handler_attached_to_event()
    {
        $eventHandlerMap = ['DummyEvent' => [$this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock()]];
        $eventBus = new EventBus($eventHandlerMap);
        self::assertSame($eventHandlerMap, $eventBus->getEventHandlerMap());
    }

    public function test_it_stores_many_event_handlers_attached_to_event()
    {
        $eventHandlerMap = [
            'DummyEvent' => [
                $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->setMockClassName('DummyHandler')->getMock(),
                $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->setMockClassName('FancyHandler')->getMock()
            ],
            'FancyEvent' => [
                $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock(),
            ],
        ];
        $eventBus = new EventBus($eventHandlerMap);
        self::assertSame($eventHandlerMap, $eventBus->getEventHandlerMap());
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

    public function test_it_publishes_event_to_attached_handlers()
    {
        $event = $this->getEventMock('FirstEvent');

        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $handler->expects(self::once())->method('handle');
        $handler2 = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $handler2->expects(self::once())->method('handle');

        $eventBusBuilder = new EventBusBuilder();
        $eventBusBuilder->attach($event::getName(), $handler);
        $eventBusBuilder->attach($event::getName(), $handler2);

        $eventBus = $eventBusBuilder->build();
        $eventBus->publish($event);
    }

    public function test_it_doesnt_publish_event_to_not_attached_handlers()
    {
        $event = $this->getEventMock('FirstEvent');
        $event2 = $this->getEventMock('SecondEvent');

        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $handler->expects(self::never())->method('handle');
        $handler2 = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $handler2->expects(self::once())->method('handle');

        $eventBusBuilder = new EventBusBuilder();
        $eventBusBuilder->attach($event::getName(), $handler);
        $eventBusBuilder->attach($event2::getName(), $handler2);

        $eventBus = $eventBusBuilder->build();
        $eventBus->publish($event2);
    }

    private function getEventMock($name)
    {
        $mockEvent = \Mockery::namedMock($name, 'PickMeUp\App\Event\Event');
        $mockEvent->shouldReceive('getName')->andReturn($name);

        return $mockEvent;
    }
}
