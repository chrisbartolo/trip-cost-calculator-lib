<?php

namespace Trip\Calculator\Interfaces;


use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

interface GeoService
{
    public function __construct($apiKey = null);

    public function getDirections(Trip $trip);

    public function getCoordinatesFromAddress(string $address);

    public function getAddressFromCoordinates(Point $point);

    public function getTravelledKilometers();

    public function getTravelTimeMinutes();

}