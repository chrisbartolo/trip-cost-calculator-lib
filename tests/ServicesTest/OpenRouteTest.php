<?php

namespace Trip\Tests\ServicesTest;

use PHPUnit\Framework\TestCase;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Services\OpenRoute;

class OpenRouteTest extends TestCase
{
    private OpenRoute $openRoute;

    public function setUp(): void
    {
        $this->openRoute = new OpenRoute("5b3ce3597851110001cf624840bc876cfc964da3a77c9e1acf6bdcd6");
    }

    public function testGetDirections()
    {
        $trip = new Trip();
        $trip->addPoint(new Point(35.9209289,14.4838945)); // 14.4838945,35.9209289
        $trip->addPoint(new Point(35.9202898,14.4831351)); // 14.4831351,35.9202898

        $this->openRoute->fetchDirectionsFromApi($trip);

        $directions = $this->openRoute->getDirections();

        $this->assertGreaterThan(1, count($directions));

    }

    public function testGetAddressFromCoordinates()
    {
        $point = new Point(35.9207722, 14.4839383);

        $streetResult = $this->openRoute->getAddressFromCoordinates($point);
        $this->assertEquals("Triq Il-Gejza, Swieqi, Malta", $streetResult);
    }

    public function testGetCoordinatesFromAddress()
    {
        $point = $this->openRoute->getCoordinatesFromAddress("Triq Il-Gejza, Swieqi, Malta");

        $expected = new Point(35.92076, 14.483977);
        $this->assertEquals($expected, $point);
    }
}

?>