<?php

namespace PickMeUp\App\Event;

use PickMeUp\App\Model\Ride;
use PickMeUp\App\Model\RideId;
use PickMeUp\CQRS\Event\Event;

class ExpiredRide implements Event
{
    /**
     * @var RideId
     */
    private $rideId;

    public function __construct(RideId $rideId)
    {
        $this->rideId = $rideId;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'expired_ride';
    }

    /**
     * @return RideId
     */
    public function getRideId()
    {
        return $this->rideId;
    }
}