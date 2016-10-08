<?php

namespace PickMeUp\App\Model;

use PickMeUp\App\Model\Geolocation\Coordinates;

class Ride
{
    const STATUS_PENDING = 'pending';

    /**
     * @var User
     */
    private $requester;

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
     * @param User $requester
     * @param Coordinates $coordinatesStart
     * @param Coordinates $coordinatesEnd
     * @param \DateTime $createdAt
     * @param ExpirationMinutes $expirationMinutes
     */
    public function __construct(User $requester, Coordinates $coordinatesStart, Coordinates $coordinatesEnd, \DateTime $createdAt, ExpirationMinutes $expirationMinutes)
    {
        $this->requester = $requester;
        $this->coordinatesStart = $coordinatesStart;
        $this->coordinatesEnd = $coordinatesEnd;
        $this->createdAt = $createdAt;
        $this->expirationMinutes = $expirationMinutes;

        $this->setInitialStatus();
    }

    private function setInitialStatus()
    {
        $this->status = self::STATUS_PENDING;
    }

    /**
     * @return User
     */
    public function getRequester()
    {
        return $this->requester;
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
}