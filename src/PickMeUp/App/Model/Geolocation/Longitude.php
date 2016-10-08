<?php

namespace PickMeUp\App\Model\Geolocation;

class Longitude
{
    /**
     * @var float
     */
    private $value;

    /**
     * Longitude constructor.
     * @param $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        $value = (float) $value;
        if ($value < -180.0 || $value > 180.0) {
            throw new \InvalidArgumentException('Passed value is out of range (-180.0, 180.0)');
        }

        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}