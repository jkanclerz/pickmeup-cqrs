<?php

namespace PickMeUp\App\Handler;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\DAL\PickUpRequest\Storage;

class PickUpRequestHandler
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * PickUpRequestHandler constructor.
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param PickUpRequestCommand $pickUpRequest
     */
    public function handle(PickUpRequestCommand $pickUpRequest)
    {
        $this->storage->save($pickUpRequest);
    }
}