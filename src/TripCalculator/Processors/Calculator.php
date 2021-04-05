<?php

namespace Trip\Calculator\Processors;

use Decimal\Decimal;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;

class Calculator
{
    private GeoService $geoService;
    private Trip $trip;
    private Vehicle $vehicle;

    public function __construct(GeoService $geoService, Trip $trip, Vehicle $vehicle)
    {
        $this->geoService = $geoService;
        $this->trip = $trip;
        $this->vehicle = $vehicle;
    }

    public function generate()
    {
        $result = $this->geoService->getDirections($this->trip);
        $this->trip->distanceKilometers = $result->routes[0]->summary->distance;
        $this->trip->travelTimeMinutes = $result->routes[0]->summary->duration;
    }

    public function getDistance(): float
    {
        if($this->trip->distanceKilometers = 0)
        {
            //TODO: Fetch distance from API
        }

        return $this->trip->distanceKilometers;
    }

    public function getTravellingTime(): int
    {
        if($this->trip->travelTimeMinutes = 0)
        {
            //TODO: Fetch time from API
        }

        return $this->trip->travelTimeMinutes;
    }

    public function calculateCost(): float
    {
        $driverCostMinutely = $this->trip->driverHourly / 60;
        $driverCost = $this->trip->travelTimeMinutes * $driverCostMinutely;

        $vehicleFuelLitreConsumed = $this->trip->distanceKilometers * ($this->vehicle->fuelLitrePerHundred / 100);
        $vehicleCost = $vehicleFuelLitreConsumed * $this->trip->fuelCostLitre;

        $vehicleWearTearCost = $this->trip->travelTimeMinutes * ($this->vehicle->wearTearHourly / 60);

        $totalCost = $driverCost + $vehicleCost + $vehicleWearTearCost;
        return round($totalCost, 2);
    }

}