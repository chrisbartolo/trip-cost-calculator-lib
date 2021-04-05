<?php

namespace Trip\Calculator\Objects;


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