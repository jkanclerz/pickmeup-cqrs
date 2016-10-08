<?php

namespace PickMeUp\App\Handler;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\DAL\Ride\Storage;
use PickMeUp\App\Factory\RideFactory;

class PickUpRequestHandler
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
     * @param PickUpRequestCommand $command
     */
    public function handle(PickUpRequestCommand $command)
    {
        $ride = $this->factory->createFromPickUpRequestCommand($command);
        $this->storage->save($ride);
    }
}