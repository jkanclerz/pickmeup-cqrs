<?php

namespace Tests\PickMeUp\CQRS\EventBus;

use PickMeUp\CQRS\Event\Event;
use PickMeUp\CQRS\EventBus\EventBus;
use PickMeUp\CQRS\EventBus\EventBusBuilder;
use PickMeUp\CQRS\EventHandler\EventHandler;

class EventBusTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_stores_event_handler_attached_to_event()
    {
        $eventHandlerMap = ['DummyEvent' => [$this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock()]];
        $eventBus = new EventBus($eventHandlerMap);
        self::assertSame($eventHandlerMap, $eventBus->getEventHandlerMap());
    }

    public function test_it_stores_many_event_handlers_attached_to_event()
    {
        $eventHandlerMap = [
            'DummyEvent' => [
                $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->setMockClassName('DummyHandler')->getMock(),
                $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->setMockClassName('FancyHandler')->getMock()
            ],
            'FancyEvent' => [
                $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock(),
            ],
        ];
        $eventBus = new EventBus($eventHandlerMap);
        self::assertSame($eventHandlerMap, $eventBus->getEventHandlerMap());
    }

    /**
     * @expectedException \PickMeUp\CQRS\EventBus\MultipleSameEventHandlerAttachAttemptException
     */
    public function test_it_allows_attach_unique_eventhandlers_to_specific_event()
    {
        $event = $this->getMockBuilder('PickMeUp\CQRS\Event\Event')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock();
        $eventHandlerMap = [get_class($event) => [$handler, $handler]];
        new EventBus($eventHandlerMap);
    }

    public function test_it_publishes_event_to_attached_handlers()
    {
        $event = $this->getEventMock('FirstEvent');

        $handler = $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock();
        $handler->expects(self::once())->method('handle');
        $handler2 = $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock();
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

        $handler = $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock();
        $handler->expects(self::never())->method('handle');
        $handler2 = $this->getMockBuilder('PickMeUp\CQRS\EventHandler\EventHandler')->getMock();
        $handler2->expects(self::once())->method('handle');

        $eventBusBuilder = new EventBusBuilder();
        $eventBusBuilder->attach($event::getName(), $handler);
        $eventBusBuilder->attach($event2::getName(), $handler2);

        $eventBus = $eventBusBuilder->build();
        $eventBus->publish($event2);
    }

    private function getEventMock($name)
    {
        $mockEvent = \Mockery::namedMock($name, 'PickMeUp\CQRS\Event\Event');
        $mockEvent->shouldReceive('getName')->andReturn($name);

        return $mockEvent;
    }
}
