<?php

namespace Tests\PickMeUp\CQRS\CommandHandler;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Event\CreatedRideRequest;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\App\CommandHandler\RideRequestHandler;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\WriteStorage\RideStorage;
use PickMeUp\CQRS\Command\Command;
use PickMeUp\CQRS\EventBus\EventBus;

class RideRequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_handles_ride_request()
    {
        $factory = $this->getMockBuilder(RideFactory::class)->getMock();
        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();

        $command = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();
        $handler = new RideRequestHandler($storage, $factory, $eventBus);
        self::assertTrue($handler->supportsCommand($command));
    }

    /**
     * @expectedException \PickMeUp\CQRS\CommandHandler\UnsupportedCommandException
     */
    public function test_it_throws_exception_when_invalid_command_is_passed()
    {
        $command = $this->getMockBuilder(Command::class)->disableOriginalConstructor()->getMock();

        $factory = $this->getMockBuilder(RideFactory::class)->getMock();
        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();

        $handler = new RideRequestHandler($storage, $factory, $eventBus);
        $handler->handle($command);
    }
    
    public function test_it_saves_user_ride_request_in_storage()
    {
        $rideRequest = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();

        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();

        $factory = $this->getMockBuilder(RideFactory::class)->getMock();
        $factory->expects(self::once())->method('createFromRideRequestCommand')->with($rideRequest)->willReturn($ride);

        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $storage->expects(self::once())->method('save')->with($ride);

        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();

        $handler = new RideRequestHandler($storage, $factory, $eventBus);
        $handler->handle($rideRequest);
    }

    public function test_it_publishes_created_ride_request_event_after_successful_handling()
    {
        $rideRequest = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();

        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();

        $factory = $this->getMockBuilder(RideFactory::class)->getMock();
        $factory->expects(self::once())->method('createFromRideRequestCommand')->with($rideRequest)->willReturn($ride);

        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $storage->expects(self::once())->method('save')->with($ride);

        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();
        $eventBus->expects(self::once())->method('publish')->with($this->isInstanceOf(CreatedRideRequest::class));

        $handler = new RideRequestHandler($storage, $factory, $eventBus);
        $handler->handle($rideRequest);
    }
}