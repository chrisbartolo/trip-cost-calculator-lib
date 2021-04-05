<?php

namespace Trip\Tests\ProcessorsTest;

use Decimal\Decimal;
use Trip\Tests\SetupAbstract;

class CalculatorTest extends SetupAbstract
{
    public function testCalculateDriverCost()
    {
        $travelTimeMinutes = 60;
        $expectedCost = $this->driverHourlyRate/60 * $travelTimeMinutes;
        $result = $this->calculator->calculateDriverCost($this->driverHourlyRate, $travelTimeMinutes);
        $this->assertEquals($expectedCost, $result);
    }

    public function testCalculateFuelCost()
    {
        $travelledKilometers = 100;
        $expectedCost = new Decimal(($this->fuelLitrePerHundred / 100)."") * new Decimal($travelledKilometers."") * $this->fuelCostLitre;
        $result = $this->calculator->calculateFuelCost($this->fuelCostLitre, $travelledKilometers, $this->fuelLitrePerHundred);
        $this->assertEquals($expectedCost, $result);
    }

    public function testCalculateWearTearCost()
    {
        $travelTimeMinutes = 60;
        $expectedCost = new Decimal((($this->wearTearHourly / 60) * $travelTimeMinutes)."");
        $result = $this->calculator->calculateVehicleWearTearCost($this->wearTearHourly, $travelTimeMinutes);
        $this->assertEquals($expectedCost, $result);
    }

}