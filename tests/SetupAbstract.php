<?php

namespace Trip\Tests;

use Decimal\Decimal;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Trip\Calculator\Objects\Driver;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Vehicle;
use Trip\Calculator\Processors\Calculator;
use Trip\Calculator\Services\OpenRoute;
use Trip\Calculator\TripCalculator;

class SetupAbstract extends TestCase
{
    public TripCalculator $tripCalculator;
    public Calculator $calculator;

    public Decimal $wearTearHourly;
    public int $fuelLitrePerHundred;
    public Decimal $fuelCostLitre;
    public Decimal $driverHourlyRate;

    public function setUp(): void
    {

        $this->wearTearHourly = new Decimal("1.00");
        $this->fuelLitrePerHundred = 9;
        $this->fuelCostLitre = new Decimal("1.24");
        $this->driverHourlyRate = new Decimal("10.00");


        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->useAutowiring(true);

        $builder->addDefinitions(
            [
                'Trip\Calculator\Interfaces\GeoService' => function (ContainerInterface $c) {
                    return new OpenRoute("5b3ce3597851110001cf624840bc876cfc964da3a77c9e1acf6bdcd6");
                },
                'Trip\Calculator\Objects\Trip' => function (ContainerInterface $c) {
                    $trip = new Trip();
                    $trip->addPoint(new Point(14.4819237, 35.920715));
                    $trip->addPoint(new Point(14.4526501, 35.9366694));
                    $trip->fuelCostLitre = $this->fuelCostLitre;
                    return $trip;
                },
                'Trip\Calculator\Objects\Vehicle' => function (ContainerInterface $c) {
                    $vehicle = new Vehicle();
                    $vehicle->wearTearHourly = $this->wearTearHourly;
                    $vehicle->fuelLitrePerHundred = $this->fuelLitrePerHundred;
                    $vehicle->name = "DCA-429";
                    return $vehicle;
                },
                'Trip\Calculator\Objects\Driver' => function (ContainerInterface $c) {
                    $driver = new Driver();
                    $driver->hourlyRate = $this->driverHourlyRate;
                    return $driver;
                }
            ]
        );

        $container = $builder->build();

        $this->tripCalculator = $container->get("Trip\Calculator\TripCalculator");
        $this->calculator = $container->get("Trip\Calculator\Processors\Calculator");

    }
}