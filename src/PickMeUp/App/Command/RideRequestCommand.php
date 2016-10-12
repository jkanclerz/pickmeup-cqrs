<?php

namespace PickMeUp\App\Command;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;
use PickMeUp\CQRS\Command\Command;

class RideRequestCommand implements Command
{
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
     * @param RideId $rideId
     * @param UserId $requesterId
     * @param Coordinates $coordinatesStart
     * @param Coordinates $coordinatesEnd
     * @param \DateTime $createdAt
     * @param ExpirationMinutes $expirationMinutes
     */
    public function __construct(RideId $rideId, UserId $requesterId, Coordinates $coordinatesStart, Coordinates $coordinatesEnd, \DateTime $createdAt, ExpirationMinutes $expirationMinutes)
    {
        $this->requesterId = $requesterId;
        $this->coordinatesStart = $coordinatesStart;
        $this->coordinatesEnd = $coordinatesEnd;
        $this->createdAt = $createdAt;
        $this->expirationMinutes = $expirationMinutes;
        $this->rideId = $rideId;
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

    /**
     * @return RideId
     */
    public function getRideId()
    {
        return $this->rideId;
    }
}