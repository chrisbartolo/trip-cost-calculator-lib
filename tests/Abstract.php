<?php

namespace Trip\Tests;


final class TripCalculatorTest extends SetupAbstract
{
    public function testDependencyInjection()
    {

        $costCalculation  = $this->tripCalculator->calculateTrip();
        var_dump($costCalculation);
    }
}