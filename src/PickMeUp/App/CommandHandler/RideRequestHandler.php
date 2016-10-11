<?php

namespace PickMeUp\App\CommandHandler;

use PickMeUp\App\Command\Command;
use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\DAL\Ride\Storage;
use PickMeUp\App\Factory\RideFactory;

class RideRequestHandler implements CommandHandler
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var RideFactory
     */
    private $factory;

    /**
     * RideRequestHandler constructor.
     * @param Storage $storage
     * @param RideFactory $factory
     */
    public function __construct(Storage $storage, RideFactory $factory)
    {
        $this->storage = $storage;
        $this->factory = $factory;
    }

    /**
     * @param Command $command
     * @throws \PickMeUp\App\CommandHandler\UnsupportedCommandException
     */
    public function handle(Command $command)
    {
        if (!$this->supportsCommand($command)) {
            throw new UnsupportedCommandException();
        }

        /** @var \PickMeUp\App\Command\RideRequestCommand $command */
        $ride = $this->factory->createFromRideRequestCommand($command);
        $this->storage->save($ride);
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