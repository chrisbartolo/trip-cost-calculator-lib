<?php

namespace Trip\Calculator\Objects;

use Decimal\Decimal;

class Trip
{

    public string $name;

    public Decimal $fuelCostLitre;
    public bool $calculated = false;
    public float $travelledKilometers = 0;
    public int $travelTimeMinutes = 0;
    private array $points = [];

    public function addPoint(Point $point)
    {
        $this->points[] = $point;
    }

    public function addPointFromCoordArray(Array $array)
    {
        $this->points[] = new Point($array[0], $array[1]);
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
        foreach ($this->points as $point) {
            /* @var $point Point */
            $coordinates[] = [$point->longitude, $point->latitude];
        }

        return $coordinates;
    }

}