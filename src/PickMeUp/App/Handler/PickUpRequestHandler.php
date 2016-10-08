<?php

namespace PickMeUp\App\Handler;

use PickMeUp\App\Command\PickUpRequest;
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
     * @param PickUpRequest $pickUpRequest
     */
    public function handle(PickUpRequest $pickUpRequest)
    {
        $this->storage->save($pickUpRequest);
    }
}