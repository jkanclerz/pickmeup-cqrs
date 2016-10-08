<?php

namespace PickMeUp\App\DAL\Ride;

use PickMeUp\App\Model\Ride;

interface Storage
{
    /**
     * @param Ride $ride
     * @throws \Exception
     * @return void
     */
    public function save(Ride $ride);
}