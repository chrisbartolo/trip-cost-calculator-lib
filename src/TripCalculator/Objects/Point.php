<?php

namespace Trip\Calculator\Objects;


use Decimal\Decimal;

class Point
{

    public float $latitude;
    public float $longitude;

    public function __construct(float $latitude, float $longitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

}