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
        $event = $this->getMockBuilder('PickMeUp\App\Event\Event')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();
        $builder = new EventBusBuilder();
        $builder->attach(get_class($event), $handler);
        $eventBus = $builder->build();

        self::assertSame([get_class($event) => [$handler]], $eventBus->getEventHandlerMap());
    }

    public function test_it_has_implemented_fluent_interface()
    {
        $event = $this->getMockBuilder('PickMeUp\App\Event\Event')->getMock();
        $handler = $this->getMockBuilder('PickMeUp\App\EventHandler\EventHandler')->getMock();

        $builder = new EventBusBuilder();
        $result = $builder->attach(get_class($event), $handler);


        static::assertSame($builder, $result);
    }
}