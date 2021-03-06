<?php

namespace PickMeUp\App\Model;

use PickMeUp\App\Command\RideExpireCommand;
use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\WriteStorage\Result\RideResult;

class Ride
{
    const STATUS_PENDING = 'pending';
    const STATUS_EXPIRED = 'expired';

    /**
     * @var RideId
     */
    private $rideId;

    /**
     * @var UserId
     */
    private $requesterId;

    /**
     * @var Coordinates
     */
    private $coordinatesStart;

    /**
     * @var Coordinates
     */
    private $coordinatesEnd;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var ExpirationMinutes
     */
    private $expirationMinutes;

    /**
     * @var string
     */
    private $status;

    /**
     * @param RideResult $rideResult
     * @return Ride
     */
    public static function createFromRideResult(RideResult $rideResult)
    {
        $ride = new static();
        $ride->rideId = $rideResult->getRideId();
        $ride->requesterId = $rideResult->getRequesterId();
        $ride->createdAt = $rideResult->getCreatedAt();
        $ride->status = $rideResult->getStatus();
        $ride->coordinatesStart = $rideResult->getCoordinatesStart();
        $ride->coordinatesEnd = $rideResult->getCoordinatesEnd();
        $ride->expirationMinutes = $rideResult->getExpirationMinutes();

        return $ride;
    }

    /**
     * @param RideRequestCommand $command
     * @return Ride
     */
    public static function applyRideRequestCommand(RideRequestCommand $command)
    {
        $ride = new static();
        $ride->rideId = $command->getRideId();
        $ride->requesterId = $command->getRequesterId();
        $ride->createdAt = $command->getCreatedAt();
        $ride->coordinatesStart = $command->getCoordinatesStart();
        $ride->coordinatesEnd = $command->getCoordinatesEnd();
        $ride->expirationMinutes = $command->getExpirationMinutes();
        $ride->status = self::STATUS_PENDING;

        return $ride;
    }

    public function applyRideExpireCommand(RideExpireCommand $command)
    {
        $this->status = self::STATUS_EXPIRED;
    }

    /**
     * @return UserId
     */
    public function getRequesterId()
    {
        return $this->requesterId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return ExpirationMinutes
     */
    public function getExpirationMinutes()
    {
        return $this->expirationMinutes;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinatesStart()
    {
        return $this->coordinatesStart;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinatesEnd()
    {
        return $this->coordinatesEnd;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return RideId
     */
    public function getRideId()
    {
        return $this->rideId;
    }
}