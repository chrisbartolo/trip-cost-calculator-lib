<?php

namespace Trip\Calculator\Interfaces;


use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

interface GeoService
{
    public function __construct($apiKey = null);

    /**
     * Fetch the directions and other data needed from the API
     * @param Trip $trip
     */
    public function fetchDirectionsFromApi(Trip $trip): void;

    /**
     * return the directions as an array of coordinates
     * @return array
     */
    public function getDirections(): array;

    /**
     * Reverse geocode from point to address
     * @param string $address
     * @return Point
     */
    public function getCoordinatesFromAddress(string $address): Point;

    /**
     * Geocode address from point
     * @param Point $point
     * @return string
     */
    public function getAddressFromCoordinates(Point $point): string;

    /**
     * Get the value of travelled kilometers from the directions between points
     * @return int km
     */
    public function getTravelledKilometers(): int;

    /**
     * Get the value of travelling time from the directions between points
     * @return int
     */
    public function getTravelTimeMinutes(): int;

}