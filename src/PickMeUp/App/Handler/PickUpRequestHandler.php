<?php

namespace PickMeUp\App\Handler;

use PickMeUp\App\Command\Command;
use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\DAL\Ride\Storage;
use PickMeUp\App\Factory\RideFactory;

class PickUpRequestHandler implements CommandHandler
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
     * PickUpRequestHandler constructor.
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
     * @throws \PickMeUp\App\Handler\UnsupportedCommandException
     */
    public function handle(Command $command)
    {
        if (!$this->supportsCommand($command)) {
            throw new UnsupportedCommandException();
        }

        $ride = $this->factory->createFromPickUpRequestCommand($command);
        $this->storage->save($ride);
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function supportsCommand(Command $command)
    {
        return $command instanceof PickUpRequestCommand;
    }
}