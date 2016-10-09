<?php

namespace PickMeUp\App\Command;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\User;

class PickUpRequestCommand implements Command
{
    /**
     * @var User
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
     * @param User $user
     * @param Coordinates $coordinatesStart
     * @param Coordinates $coordinatesEnd
     * @param \DateTime $createdAt
     * @param ExpirationMinutes $expirationMinutes
     */
    public function __construct(User $user, Coordinates $coordinatesStart, Coordinates $coordinatesEnd, \DateTime $createdAt, ExpirationMinutes $expirationMinutes)
    {
        $this->user = $user;
        $this->coordinatesStart = $coordinatesStart;
        $this->coordinatesEnd = $coordinatesEnd;
        $this->createdAt = $createdAt;
        $this->expirationMinutes = $expirationMinutes;
    }

    /**
     * @return User
     */
    public function getUser()
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