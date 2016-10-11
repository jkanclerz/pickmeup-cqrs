<?php

namespace Tests\PickMeUp\App\EventBus;

use PickMeUp\App\EventBus\EventBus;
use PickMeUp\App\EventBus\EventBusBuilder;

class EventBusBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_builds_event_bus()
    {
        $builder = new EventBusBuilder();
        self::assertInstanceOf(EventBus::class, $builder->build());
    }

    public function test_it_attaches_handlers_to_events()
    {
        $event = $this->getEventMock('DummyEvent');
        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $builder = new EventBusBuilder();
        $builder->attach($event::getName(), $handler);
        $eventBus = $builder->build();

        self::assertSame([$event::getName() => [$handler]], $eventBus->getEventHandlerMap());
    }

    public function test_it_has_implemented_fluent_interface()
    {
        $event = $this->getEventMock('DummyEvent');
        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();

        $builder = new EventBusBuilder();
        $result = $builder->attach($event::getName(), $handler);

        static::assertSame($builder, $result);
    }

    private function getEventMock($name)
    {
        $mockEvent = \Mockery::mock('alias:PickMeUp\App\Event\Event');
        $mockEvent->shouldReceive('getName')->andReturn($name);

        return $mockEvent;
    }
}