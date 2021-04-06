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

    public function getDirections(): array
    {
        return array();
    }

    public function getCoordinatesFromAddress(string $address): Point
    {
        // TODO: Implement getCoordinatesFromAddress() method.
    }

    public function getAddressFromCoordinates(Point $point): string
    {
        // TODO: Implement getAddressFromCoordinates() method.
    }

    public function getTravelledKilometers(): int
    {
        return 100;
    }

    public function getTravelTimeMinutes(): int
    {
        return 60;
    }

    public function fetchDirectionsFromApi(Trip $trip): void
    {
        // TODO: Implement fetchDirectionsFromApi() method.
    }
}