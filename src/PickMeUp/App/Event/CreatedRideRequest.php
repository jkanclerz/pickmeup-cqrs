<?php

namespace PickMeUp\App\Event;

use PickMeUp\App\Model\Ride;
use PickMeUp\CQRS\Event\Event;

class CreatedRideRequest implements Event
{
    /**
     * @var Ride
     */
    private $ride;

    public function __construct(Ride $ride)
    {
        $this->ride = $ride;
    }

    /**
     * @return string
     */
    public static function getName()
    {
        return 'created_ride_request';
    }

    /**
     * @return Ride
     */
    public function getRide()
    {
        return $this->ride;
    }
}