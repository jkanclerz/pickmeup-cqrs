<?php

namespace PickMeUp\CQRS\Event;

interface Event
{
    /**
     * @return string
     */
    public static function getName();
}