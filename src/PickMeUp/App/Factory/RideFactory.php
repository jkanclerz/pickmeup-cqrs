<?php

namespace PickMeUp\App\Factory;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Model\Ride;

class RideFactory
{
    /**
     * @param RideRequestCommand $command
     * @return Ride
     */
    public function createFromRideRequestCommand(RideRequestCommand $command)
    {
        return new Ride(
            $command->getUserId(),
            $command->getCoordinatesStart(),
            $command->getCoordinatesEnd(),
            $command->getCreatedAt(),
            $command->getExpirationMinutes()
        );
    }
}