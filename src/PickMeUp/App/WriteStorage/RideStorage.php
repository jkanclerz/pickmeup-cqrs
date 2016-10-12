<?php

namespace PickMeUp\App\WriteStorage;

use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;

interface RideStorage
{
    public function save(Ride $ride);

    /**
     * @param RideId $rideId
     * @return Ride|null
     */
    public function find(RideId $rideId);
}
