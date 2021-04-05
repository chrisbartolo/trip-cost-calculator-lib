<?php

namespace Trip\Tests\ObjectsTest;

use Decimal\Decimal;
use PHPUnit\Framework\TestCase;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

class TripTest extends TestCase
{
    public function testAddPoint()
    {
        $trip = new Trip();

        $point = new Point(0,0);

        $trip->addPoint($point);

        $this->assertEquals($point, $trip->getPoints()[0]);
    }

    public function testClearPoints()
    {
        $trip = new Trip();

        $point = new Point(0,0);

        $trip->addPoint($point);
        $trip->clearPoints();

        $this->assertEquals([], $trip->getPoints());
    }

    public function testGetPointsAsCoordinates()
    {
        $trip = new Trip();

        $coords = array();
        $coords[] = [0, 0];
        $coords[] = [1, 1];
        $coords[] = [2, 2];

        $trip->addPoint(new Point($coords[0][0],$coords[0][0]));
        $trip->addPoint(new Point($coords[1][0],$coords[1][0]));
        $trip->addPoint(new Point($coords[2][0],$coords[2][0]));

        $result = $trip->getPointsAsCoordinates();
        $this->assertEquals(json_encode($coords), json_encode($result));
    }
}

?>