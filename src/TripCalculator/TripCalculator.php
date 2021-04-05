<?php

namespace Trip\Calculator;


use Decimal\Decimal;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;
use Trip\Calculator\Processors\Calculator;
use Trip\Calculator\Services\GoogleMaps;

class TripCalculator
{
    private Trip $trip;
    private Vehicle $vehicle;
    private Calculator $calculator;
    private GeoService $geoService;

    public function __construct(GeoService $geoService, Trip $trip, Vehicle $vehicle)
    {
        $this->trip = $trip;
        $this->geoService = $geoService;
        $this->vehicle = $vehicle;
    }

    public function addTripPoint(Point $point)
    {
        $this->trip->addPoint($point);
    }

    public function calculateTrip()
    {
        $this->calculator = new Calculator($this->geoService, $this->trip, $this->vehicle);
        $this->calculator->generate();
        //return $this->calculator->calculateCost();
    }

    public function setDriverHourly(Decimal $valueInEuro): void
    {
        $this->trip->driverHourly = $valueInEuro;
    }

    public function setFuelCostLitre(Decimal $valueInEuro): void
    {
        $this->trip->fuelCostLitre = $valueInEuro;
    }

    public function setVehicleWearTearHourly(Decimal $valueInEuro): void
    {
        $this->vehicle->wearTearHourly = $valueInEuro;
    }

}