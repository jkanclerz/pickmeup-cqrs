<?php

namespace PickMeUp\App\Command;

use PickMeUp\App\Model\ExpirationMinutes;
use PickMeUp\App\Model\Geolocation\Coordinates;
use PickMeUp\App\Model\User;

class PickUpRequest
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Coordinates
     */
    private $coordinates;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var ExpirationMinutes
     */
    private $expirationMinutes;

    /**
     * PickUpRequest constructor.
     * @param User $user
     * @param Coordinates $coordinates
     * @param \DateTime $createdAt
     * @param ExpirationMinutes $expirationMinutes
     */
    public function __construct(User $user, Coordinates $coordinates, \DateTime $createdAt, ExpirationMinutes $expirationMinutes)
    {
        $this->user = $user;
        $this->coordinates = $coordinates;
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
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
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
}