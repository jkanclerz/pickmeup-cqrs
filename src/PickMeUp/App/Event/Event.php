<?php

namespace PickMeUp\App\Event;

interface Event
{
    /**
     * @return string
     */
    public function getName();
}