<?php

namespace Trip\Calculator\Objects;

use Decimal\Decimal;
use Trip\Calculator\Objects\Point;

class Trip {

    public string $name;

    public Decimal $fuelCostLitre;

    private array $points = [];

    public bool $calculated = false;
    public float $travelledKilometers = 0;
    public int $travelTimeMinutes = 0;

    public function addPoint(Point $point)
    {
        $this->points[] = $point;
    }

    public function clearPoints()
    {
        $this->points = [];
    }

    public function getPoints(): array
    {
        return $this->points;
    }

    public function getPointsAsCoordinates(): array
    {
        $coordinates = [];
        foreach($this->points as $point) {
            /* @var $point \Trip\Calculator\Objects\Point */
            $coordinates[] = [$point->latitude, $point->longitude];
        }

        return $coordinates;
    }

}