<?php


namespace Trip\Calculator;


use Decimal\Decimal;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;
use Trip\Calculator\Processor\Calculator;

class TripCalculator
{
    private Trip $trip;
    private Vehicle $vehicle;
    private Calculator $calculator;

    public function __construct()
    {
        $this->trip = new Trip();
    }

    public function addTripPoint(Point $point)
    {
        $this->trip->addPoint($point);
    }

    public function calculateTrip()
    {
        $this->calculator = new Calculator($this->trip, $this->vehicle);
        $this->calculator->generate();
        return $this->calculator->calculateCost();
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