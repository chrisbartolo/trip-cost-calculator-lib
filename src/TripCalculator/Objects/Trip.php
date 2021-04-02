<?php

namespace Trip\Calculator\Objects;

use Decimal\Decimal;

class Trip {

    public string $name;

    public Decimal $fuelCostLitre;
    public Decimal $driverHourly;

    private array $points = [];

    public bool $calculated = false;
    public float $distanceKilometers = 0;
    public int $travelTimeMinutes = 0;

    public function addPoint(Point $point)
    {
        $this->points[] = $point;
    }

    public function clearPoints()
    {
        $this->points = [];
    }



}