<?php

namespace Trip\Calculator\Processors;

use Decimal\Decimal;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Driver;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;

class Calculator
{
    private GeoService $geoService;
    private Trip $trip;
    private Vehicle $vehicle;
    private Driver $driver;

    public function __construct(GeoService $geoService, Trip $trip, Vehicle $vehicle, Driver $driver)
    {
        $this->geoService = $geoService;
        $this->trip = $trip;
        $this->vehicle = $vehicle;
        $this->driver = $driver;
    }

    public function generate()
    {
        $result = $this->geoService->getDirections($this->trip);
        $this->trip->travelledKilometers = $this->geoService->getTravelledKilometers();
        $this->trip->travelTimeMinutes = $this->geoService->getTravelTimeMinutes();
    }

    function minutesFormat($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function getDistance(): float
    {
        if ($this->trip->travelledKilometers = 0) {
            //TODO: Fetch distance from API
        }

        return $this->trip->travelledKilometers;
    }

    public function getTravellingTime(): int
    {
        if ($this->trip->travelTimeMinutes = 0) {
            //TODO: Fetch time from API
        }

        return $this->trip->travelTimeMinutes;
    }

    public function calculateCost(): float
    {
        $driverCost = $this->calculateDriverCost($this->driver->hourlyRate, $this->trip->travelTimeMinutes);
        $fuelCost = $this->calculateFuelCost($this->trip->fuelCostLitre, $this->trip->travelledKilometers, $this->vehicle->fuelLitrePerHundred);
        $vehicleWearTearCost = $this->calculateVehicleWearTearCost($this->vehicle->wearTearHourly, $this->trip->travelTimeMinutes);

        $totalCost = $driverCost + $fuelCost + $vehicleWearTearCost;
        return round($totalCost . "", 2);
    }

    public function calculateDriverCost(Decimal $hourlyRate, int $travelTimeMinutes): Decimal
    {
        $driverCostMinutely = $hourlyRate / 60;
        return new Decimal(($travelTimeMinutes * $driverCostMinutely)."");
    }

    public function calculateFuelCost(Decimal $fuelCostPerLitre, int $travelledKilometers, int $litersPerHundred): Decimal
    {
        $fuelCost = ($litersPerHundred / 100);
        $vehicleFuelLitreConsumed = new Decimal("" . ($travelledKilometers * $fuelCost));
        return new Decimal(($vehicleFuelLitreConsumed * $fuelCostPerLitre)."");
    }

    public function calculateVehicleWearTearCost(Decimal $wearTearHourly, int $travelTimeMinutes): Decimal
    {
        return new Decimal(($travelTimeMinutes * ($wearTearHourly / 60))."");
    }

}