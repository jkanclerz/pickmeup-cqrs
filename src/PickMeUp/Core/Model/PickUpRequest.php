<?php

namespace PickMeUp\Core\Model;

use PickMeUp\Core\Model\Geolocation\Coordinates;

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
     * @var int
     */
    private $expirationMinutes;

    public function __construct(User $user, Coordinates $coordinates, \DateTime $createdAt, $expirationMinutes)
    {
        if (!is_int($expirationMinutes) || $expirationMinutes < 0) {
            throw new \InvalidArgumentException();
        }

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
     * @return int
     */
    public function getExpirationMinutes()
    {
        return $this->expirationMinutes;
    }
}