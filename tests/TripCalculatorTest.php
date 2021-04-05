<?php

namespace Trip\Calculator\Tests;

use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Services\GoogleMaps;
use Trip\Calculator\Services\OpenRoute;

final class TripCalculatorTest extends TestCase
{
    public function testDependencyInjection()
    {
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
                    return $trip;
                }
            ]
        );

        $container = $builder->build();

        $tripCalculator = $container->get("Trip\Calculator\TripCalculator");
        $tripCalculator->calculateTrip();
    }
}