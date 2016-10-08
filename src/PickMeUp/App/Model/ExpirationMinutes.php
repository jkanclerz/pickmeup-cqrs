<?php

namespace PickMeUp\App\Model;

class ExpirationMinutes
{
    /**
     * @var int
     */
    protected $value;

    /**
     * ExpirationMinutes constructor.
     * @param $value
     */
    public function __construct($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException();
        }

        if ($value < 0) {
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