<?php

namespace PickMeUp\App\DAL\PickUpRequest;

use PickMeUp\App\Command\PickUpRequestCommand;

interface Storage
{
    /**
     * @param PickUpRequestCommand $pickUpRequest
     * @throws \Exception
     * @return void
     */
    public function save(PickUpRequestCommand $pickUpRequest);
}