<?php

namespace Trip\Tests;


use Decimal\Decimal;
use Trip\Calculator\Services\OpenRoute;
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

    public function testRouteCalculation()
    {
        $trip = $this->tripCalculator->getTrip();
        $trip->clearPoints();
        $trip->fuelCostLitre = new Decimal("1.21"); //Current diesel price in Malta

        // Getting coordinates from Map
        $geoService = new OpenRoute("5b3ce3597851110001cf624840bc876cfc964da3a77c9e1acf6bdcd6");
        $this->tripCalculator->setGeoService($geoService);
        $geoService = $this->tripCalculator->getGeoService();

        $startLocation = $geoService->getCoordinatesFromAddress("Triq il-Gejza, Swieqi, Malta");
        $endLocation = $geoService->getCoordinatesFromAddress("Triq l-Imdina, Qormi, Malta");
        $pickupLocation1 = $geoService->getCoordinatesFromAddress("Triq Joe Gasan, Pieta, Malta");
        $pickupLocation2 = $geoService->getCoordinatesFromAddress("Triq Guze' Bajada, Hamrun, Malta");

        // Adding coordinates to the route to fetch directions for
        $trip->addPoint($startLocation);
        $trip->addPoint($pickupLocation1);
        $trip->addPoint($pickupLocation2);
        $trip->addPoint($endLocation);

        // Lets set the vehicle configurations
        $vehicle = $this->tripCalculator->getVehicle();
        $vehicle->name = "Test Vehicle";
        $vehicle->wearTearHourly = new Decimal("5.60"); // the hourly cost for wear and tear of the vehicle
        $vehicle->fuelLitrePerHundred = 45; // assumption is that a coach uses 45l/100km

        // Lets set the driver's salary cost
        $driver = $this->tripCalculator->getDriver();
        $driver->name = "Kevin";
        $driver->hourlyRate = new Decimal("25.50");

        // Lets work the magic
        $totalCost = $this->tripCalculator->calculateTrip();

        echo "Total Trip Cost: ".number_format($totalCost, 2)." Eu \n";

        $this->assertEquals(13.19, $totalCost);
    }
}