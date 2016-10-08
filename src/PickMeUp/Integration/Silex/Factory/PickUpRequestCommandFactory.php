<?php

namespace PickMeUp\Integration\Silex\Factory;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\Geolocation\Latitude;
use PickMeUp\App\Model\Geolocation\Longitude;
use PickMeUp\App\Model\User;

class PickUpRequestCommandFactory
{
    /**
     * @param $userUuid
     * @param $expirationMinutes
     * @param $latitudeStart
     * @param $longitudeStart
     * @param $latitudeEnd
     * @param $longitudeEnd
     * @throws \InvalidArgumentException
     * @return PickUpRequestCommand
     */
    public function create(
        $userUuid,
        $expirationMinutes,
        $latitudeStart,
        $longitudeStart,
        $latitudeEnd,
        $longitudeEnd
    ) {
        $user = new User($userUuid);
        $expirationMinutes = new ExpirationMinutes((int) $expirationMinutes);
        $coordinatesStart = new Coordinates(new Latitude($latitudeStart), new Longitude($longitudeStart));
        $coordinatesEnd = new Coordinates(new Latitude($latitudeEnd), new Longitude($longitudeEnd));

        return new PickUpRequestCommand($user, $coordinatesStart, $coordinatesEnd, new \DateTime(), $expirationMinutes);
    }
}