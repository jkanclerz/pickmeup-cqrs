<?php

namespace Tests\PickMeUp\CQRS\CommandHandler;

use PickMeUp\App\Command\RideExpireCommand;
use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\CommandHandler\RideExpireHandler;
use PickMeUp\App\Event\CreatedRideRequest;
use PickMeUp\App\Event\ExpiredRide;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\App\CommandHandler\RideRequestHandler;
use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\WriteStorage\RideStorage;
use PickMeUp\CQRS\Command\Command;
use PickMeUp\CQRS\EventBus\EventBus;

class RideExpireHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_handles_ride_request()
    {
        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();

        $command = $this->getMockBuilder(RideExpireCommand::class)->disableOriginalConstructor()->getMock();
        $handler = new RideExpireHandler($storage, $eventBus);
        self::assertTrue($handler->supportsCommand($command));
    }

    /**
     * @expectedException \PickMeUp\CQRS\CommandHandler\UnsupportedCommandException
     */
    public function test_it_throws_exception_when_invalid_command_is_passed()
    {
        $command = $this->getMockBuilder(Command::class)->disableOriginalConstructor()->getMock();

        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();

        $handler = new RideExpireHandler($storage, $eventBus);
        $handler->handle($command);
    }
    
    public function test_it_saves_expired_ride_in_storage()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $command = $this->getMockBuilder(RideExpireCommand::class)->disableOriginalConstructor()->getMock();
        $command->method('getRideId')->willReturn($rideId);

        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();
        $ride->expects(self::once())->method('applyRideExpireCommand')->with($command);
        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $storage->expects(self::once())->method('find')->with($rideId)->willReturn($ride);
        $storage->expects(self::once())->method('save')->with($ride);

        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();
        $handler = new RideExpireHandler($storage, $eventBus);
        $handler->handle($command);
    }

    public function test_it_publishes_ride_expired_event_after_successful_command_handling()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $command = $this->getMockBuilder(RideExpireCommand::class)->disableOriginalConstructor()->getMock();
        $command->method('getRideId')->willReturn($rideId);

        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();
        $ride->method('applyRideExpireCommand')->with($command);
        $storage = $this->getMockBuilder(RideStorage::class)->getMock();
        $storage->method('find')->with($rideId)->willReturn($ride);
        $storage->method('save')->with($ride);

        $eventBus = $this->getMockBuilder(EventBus::class)->getMock();
        $eventBus->expects(self::once())->method('publish')->with($this->isInstanceOf(ExpiredRide::class));

        $handler = new RideExpireHandler($storage, $eventBus);
        $handler->handle($command);
    }
}