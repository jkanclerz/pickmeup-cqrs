<?php

namespace PickMeUp\App\Model;

class UserId
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * UserId constructor.
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