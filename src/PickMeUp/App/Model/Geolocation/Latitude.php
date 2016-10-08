<?php

namespace PickMeUp\App\Model\Geolocation;

class Latitude
{
    /**
     * @var float
     */
    private $value;

    /**
     * Latitude constructor.
     * @param $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        $value = (float) $value;
        if ($value < -90.0 || $value > 90.0) {
            throw new \InvalidArgumentException('Passed value is out of range (-90.0, 90.0)');
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