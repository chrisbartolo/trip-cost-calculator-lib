<?php

namespace Trip\Calculator;


use Decimal\Decimal;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Driver;
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
    private Driver $driver;

    public function __construct(GeoService $geoService, Trip $trip, Vehicle $vehicle, Driver $driver)
    {
        $this->trip = $trip;
        $this->geoService = $geoService;
        $this->vehicle = $vehicle;
        $this->driver = $driver;
    }

    public function calculateTrip()
    {
        $this->calculator = new Calculator($this->geoService, $this->trip, $this->vehicle, $this->driver);
        $this->calculator->generate();

        $result = $this->calculator->calculateCost();

        return $result;
    }

    public function getTrip()
    {
        return $this->trip;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function getCalculator()
    {
        return $this->calculator;
    }

    public function getGeoService()
    {
        return $this->geoService;
    }

    public function getDriver()
    {
        return $this->driver;
    }

}