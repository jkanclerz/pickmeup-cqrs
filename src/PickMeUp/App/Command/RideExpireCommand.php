<?php

namespace PickMeUp\App\Command;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;
use PickMeUp\CQRS\Command\Command;

class RideExpireCommand implements Command
{
    /**
     * @var RideId
     */
    private $rideId;

    /**
     * @param RideId $rideId
     */
    public function __construct(RideId $rideId)
    {
        $this->rideId = $rideId;
    }

    /**
     * @return RideId
     */
    public function getRideId()
    {
        return $this->rideId;
    }
}