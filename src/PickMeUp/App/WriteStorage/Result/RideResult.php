<?php

namespace PickMeUp\App\WriteStorage\Result;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\RideId;
use PickMeUp\App\Model\UserId;

class RideResult
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
     * @var string
     */
    private $status;

    /**
     * @param RideId $rideId
     */
    public function setRideId(RideId $rideId)
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

    /**
     * @return UserId
     */
    public function getRequesterId()
    {
        return $this->requesterId;
    }

    /**
     * @param UserId $requesterId
     */
    public function setRequesterId(UserId $requesterId)
    {
        $this->requesterId = $requesterId;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinatesStart()
    {
        return $this->coordinatesStart;
    }

    /**
     * @param Coordinates $coordinatesStart
     */
    public function setCoordinatesStart(Coordinates $coordinatesStart)
    {
        $this->coordinatesStart = $coordinatesStart;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinatesEnd()
    {
        return $this->coordinatesEnd;
    }

    /**
     * @param Coordinates $coordinatesEnd
     */
    public function setCoordinatesEnd(Coordinates $coordinatesEnd)
    {
        $this->coordinatesEnd = $coordinatesEnd;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return ExpirationMinutes
     */
    public function getExpirationMinutes()
    {
        return $this->expirationMinutes;
    }

    /**
     * @param ExpirationMinutes $expirationMinutes
     */
    public function setExpirationMinutes(ExpirationMinutes $expirationMinutes)
    {
        $this->expirationMinutes = $expirationMinutes;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}