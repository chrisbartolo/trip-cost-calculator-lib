<?php

namespace Trip\Calculator\Processor;

use Decimal\Decimal;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;

class Calculator
{
    private Trip $trip;
    private Vehicle $vehicle;

    public function __construct(Trip $trip, Vehicle $vehicle)
    {
        $this->trip = $trip;
        $this->vehicle = $vehicle;
    }

    public function generate()
    {
        $result = [];
        //TODO: call generate API
        $this->trip->distance = $result['distance'];
        $this->trip->travelTimeMinutes = $result['eta'];
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