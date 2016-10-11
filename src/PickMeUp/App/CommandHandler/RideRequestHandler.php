<?php

namespace PickMeUp\App\CommandHandler;

use PickMeUp\App\Event\CreatedRideRequest;
use PickMeUp\App\WriteStorage\RideStorage;
use PickMeUp\CQRS\Command\Command;
use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\CQRS\CommandHandler\CommandHandler;
use PickMeUp\CQRS\CommandHandler\UnsupportedCommandException;
use PickMeUp\CQRS\EventBus\EventBus;

class RideRequestHandler implements CommandHandler
{
    /**
     * @var RideStorage
     */
    private $storage;

    /**
     * @var RideFactory
     */
    private $factory;

    /**
     * @var EventBus
     */
    private $eventBus;

    /**
     * RideRequestHandler constructor.
     * @param RideStorage $storage
     * @param RideFactory $factory
     * @param EventBus $eventBus
     */
    public function __construct(RideStorage $storage, RideFactory $factory, EventBus $eventBus)
    {
        $this->storage = $storage;
        $this->factory = $factory;
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

        /** @var \PickMeUp\App\Command\RideRequestCommand $command */
        $ride = $this->factory->createFromRideRequestCommand($command);
        $this->storage->save($ride);
        $this->eventBus->publish(new CreatedRideRequest($ride));
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function supportsCommand(Command $command)
    {
        return $command instanceof RideRequestCommand;
    }
}