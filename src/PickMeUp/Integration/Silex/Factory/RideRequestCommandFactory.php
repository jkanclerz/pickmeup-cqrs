<?php

namespace PickMeUp\Integration\Silex\Factory;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Geolocation\Latitude;
use PickMeUp\App\Model\Geolocation\Longitude;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;

class RideRequestCommandFactory
{
    /**
     * @param RideId $rideId
     * @param $requesterUuid
     * @param $expirationMinutes
     * @param $latitudeStart
     * @param $longitudeStart
     * @param $latitudeEnd
     * @param $longitudeEnd
     * @return RideRequestCommand
     */
    public function create(
        RideId $rideId,
        $requesterUuid,
        $expirationMinutes,
        $latitudeStart,
        $longitudeStart,
        $latitudeEnd,
        $longitudeEnd
    ) {
        $requesterId = new UserId($requesterUuid);
        $expirationMinutes = new ExpirationMinutes((int) $expirationMinutes);
        $coordinatesStart = new Coordinates(new Latitude($latitudeStart), new Longitude($longitudeStart));
        $coordinatesEnd = new Coordinates(new Latitude($latitudeEnd), new Longitude($longitudeEnd));

        return new RideRequestCommand($rideId, $requesterId, $coordinatesStart, $coordinatesEnd, new \DateTime(), $expirationMinutes);
    }
}