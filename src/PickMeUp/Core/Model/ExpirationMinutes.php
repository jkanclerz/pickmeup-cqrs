<?php

namespace PickMeUp\Core\Model;

class ExpirationMinutes
{
    /**
     * @var int
     */
    protected $value;

    public function __construct($value)
    {
        if (!is_int($value) || $value < 0) {
            throw new \InvalidArgumentException();
        }
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}