<?php

namespace PickMeUp\App\Model;

class RideId
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * RideId constructor.
     * @param $uuid
     */
    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}