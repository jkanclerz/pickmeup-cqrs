<?php

namespace PickMeUp\App\Factory;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\Model\Ride;

class RideFactory
{
    public function createFromPickUpRequestCommand(PickUpRequestCommand $command)
    {
        return new Ride(
            $command->getUser(),
            $command->getCoordinatesStart(),
            $command->getCoordinatesEnd(),
            $command->getCreatedAt(),
            $command->getExpirationMinutes()
        );
    }
}