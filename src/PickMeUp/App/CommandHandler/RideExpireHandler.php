<?php

namespace PickMeUp\App\CommandHandler;

use PickMeUp\App\Command\RideExpireCommand;
use PickMeUp\App\Event\ExpiredRide;
use PickMeUp\App\WriteStorage\RideStorage;
use PickMeUp\CQRS\Command\Command;
use PickMeUp\CQRS\CommandHandler\CommandHandler;
use PickMeUp\CQRS\CommandHandler\UnsupportedCommandException;
use PickMeUp\CQRS\EventBus\EventBus;

class RideExpireHandler implements CommandHandler
{
    /**
     * @var RideStorage
     */
    private $storage;

    /**
     * @var EventBus
     */
    private $eventBus;

    /**
     * RideRequestHandler constructor.
     * @param RideStorage $storage
     * @param EventBus $eventBus
     */
    public function __construct(RideStorage $storage, EventBus $eventBus)
    {
        $this->storage = $storage;
        $this->eventBus = $eventBus;
    }

    /**
     * @param Command $command
     * @throws UnsupportedCommandException
     */
    public function handle(Command $command)
    {
        if (!$this->supportsCommand($command)) {
            throw new UnsupportedCommandException();
        }

        /** @var \PickMeUp\App\Command\RideExpireCommand $command */
        $rideId = $command->getRideId();
        $ride = $this->storage->find($rideId);
        $ride->applyRideExpireCommand($command);
        $this->storage->save($ride);
        $this->eventBus->publish(new ExpiredRide($rideId));
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function supportsCommand(Command $command)
    {
        return $command instanceof RideExpireCommand;
    }
}