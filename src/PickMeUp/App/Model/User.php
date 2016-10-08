<?php

namespace PickMeUp\App\Model;

class User
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * User constructor.
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