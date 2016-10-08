<?php

namespace PickMeUp\App\DAL\PickUpRequest;

use PickMeUp\App\Command\PickUpRequest;

interface Storage
{
    /**
     * @param PickUpRequest $pickUpRequest
     * @throws \Exception
     * @return void
     */
    public function save(PickUpRequest $pickUpRequest);
}