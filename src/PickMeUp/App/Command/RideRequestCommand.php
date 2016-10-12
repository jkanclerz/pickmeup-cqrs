<?php

namespace PickMeUp\App\Command;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\UserId;
use PickMeUp\CQRS\Command\Command;

class RideRequestCommand implements Command
{
    /**
     * @var UserId
     */
    private $user;

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
     * @param UserId $user
     * @param Coordinates $coordinatesStart
     * @param Coordinates $coordinatesEnd
     * @param \DateTime $createdAt
     * @param ExpirationMinutes $expirationMinutes
     */
    public function __construct(UserId $user, Coordinates $coordinatesStart, Coordinates $coordinatesEnd, \DateTime $createdAt, ExpirationMinutes $expirationMinutes)
    {
        $this->user = $user;
        $this->coordinatesStart = $coordinatesStart;
        $this->coordinatesEnd = $coordinatesEnd;
        $this->createdAt = $createdAt;
        $this->expirationMinutes = $expirationMinutes;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->user;
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
}