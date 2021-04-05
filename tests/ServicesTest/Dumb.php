<?php

namespace Trip\Tests\ServicesTest;

use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

class Dumb implements GeoService
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

    public function getTravelledKilometers()
    {
        return 100;
    }

    public function getTravelTimeMinutes()
    {
        return 60;
    }
}