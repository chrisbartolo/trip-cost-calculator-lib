<?php

namespace Trip\Calculator\Services;


use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Point;

class GoogleMaps implements GeoService
{

    public function __construct($apiKey = null)
    {
    }

    public function getDirections(Trip $trip)
    {
        // TODO: Implement getDirections() method.
    }

    public function getCoordinatesFromAddress(string $address)
    {
        // TODO: Implement getCoordinatesFromAddress() method.
    }

    public function getAddressFromCoordinates(Point $point)
    {
        // TODO: Implement getAddressFromCoordinates() method.
    }
}