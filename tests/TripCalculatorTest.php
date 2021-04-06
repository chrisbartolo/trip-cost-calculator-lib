<?php

namespace Trip\Tests;


use Trip\Tests\ProcessorsTest\CalculatorTest;

final class TripCalculatorTest extends SetupAbstract
{
    public function testCalculateTrip()
    {
        $calculatorTest = new CalculatorTest();
        $calculatorTest->setInitialValues();

        $costCalculation  = $this->tripCalculator->calculateTrip();
        $this->assertEquals($calculatorTest->calculateTotalCost(), $costCalculation);
    }
}