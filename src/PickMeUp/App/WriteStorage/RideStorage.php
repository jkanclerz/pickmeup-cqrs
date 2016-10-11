<?php

namespace PickMeUp\App\WriteStorage;

use PickMeUp\App\Model\Ride;

interface RideStorage
{
    public function save(Ride $ride);
}
