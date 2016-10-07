<?php

namespace PickMeUp\Core\Model;

class User
{
    private $uuid;

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