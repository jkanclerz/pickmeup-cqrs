<?php

namespace PickMeUp\Core\Model\Geolocation;

class Coordinates
{
    /**
     * @var Latitude
     */
    private $latitude;
    /**
     * @var Longitude
     */
    private $longitude;

    /**
     * Coordinates constructor.
     * @param Latitude $latitude
     * @param Longitude $longitude
     */
    public function __construct(Latitude $latitude, Longitude $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return Longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return Latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
}