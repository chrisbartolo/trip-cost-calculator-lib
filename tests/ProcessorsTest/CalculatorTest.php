<?php

namespace Trip\Tests\ProcessorsTest;

use Decimal\Decimal;
use Trip\Tests\SetupAbstract;

class CalculatorTest extends SetupAbstract
{

    public function testMinutesFormat()
    {
        $timeInSeconds = 360;
        $timeResult = $this->calculator->minutesFormat($timeInSeconds);
        $this->assertEquals("06:00", $timeResult);
    }

    public function calculateDriverCost()
    {
        return ($this->driverHourlyRate/60) * $this->travelTimeMinutes;
    }

    public function testCalculateDriverCost()
    {
        $expected = $this->calculateDriverCost();
        $result = $this->calculator->calculateDriverCost($this->driverHourlyRate, $this->travelTimeMinutes);
        $this->assertEquals($expected, $result);
    }

    public function calculateFuelCost()
    {
        return new Decimal(($this->fuelLitrePerHundred / 100)."") * new Decimal($this->travelledKilometers."") * $this->fuelCostLitre;
    }

    public function testCalculateFuelCost()
    {
        $expected = $this->calculateFuelCost();
        $result = $this->calculator->calculateFuelCost($this->fuelCostLitre, $this->travelledKilometers, $this->fuelLitrePerHundred);
        $this->assertEquals($expected, $result);
    }

    public function calculateWearTearCost()
    {
        return new Decimal((($this->wearTearHourly / 60) * $this->travelTimeMinutes)."");
    }

    public function testCalculateWearTearCost()
    {
        $expected = $this->calculateWearTearCost();
        $result = $this->calculator->calculateVehicleWearTearCost($this->wearTearHourly, $this->travelTimeMinutes);
        $this->assertEquals($expected, $result);
    }

    public function calculateTotalCost()
    {
        return round(($this->calculateFuelCost() + $this->calculateDriverCost() + $this->calculateWearTearCost().""), 2);;
    }

    public function testCalculateTotalCost()
    {
        $this->tripCalculator->getTrip()->travelTimeMinutes = $this->travelTimeMinutes;
        $this->tripCalculator->getTrip()->travelledKilometers = $this->travelledKilometers;

        $expectedTotalCost = $this->calculateTotalCost();
        $result = $this->calculator->calculateCost();
        $this->assertEquals($expectedTotalCost, $result);
    }
}