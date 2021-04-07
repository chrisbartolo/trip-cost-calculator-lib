# Trip Cost Calculator - Library
[![codecov](https://codecov.io/gh/chrisbartolo/trip-cost-calculator-lib/branch/main/graph/badge.svg?token=M6UOWNBSSC)](https://codecov.io/gh/chrisbartolo/trip-cost-calculator-lib)
[![Build Status](https://www.travis-ci.com/chrisbartolo/trip-cost-calculator-lib.svg?branch=main)](https://www.travis-ci.com/chrisbartolo/trip-cost-calculator-lib)


The Trip Cost Calculator provides easy functionality for evaluating the total cost for a pre-defined route that your vehicle will travel.
The parameters supported and considered in cost calculation are:
* route distance in km
* route travelling time
* driver salary hourly rate
* vehicle wear and tear costs

The library is using PHP-DI 

## Basic Usage
```
<?php

use DI\ContainerBuilder;
use Trip\Calculator\TripCalculator;
use Trip\Calculator;

$apiKey = "";

$diBuilder = new ContainerBuilder();
$diBuilder->addDefinitions(
    [
        'Trip\Calculator\Interfaces\GeoService' => function (ContainerInterface $c) {
            return $geoService = new OpenRoute($apiKey);
        }
    ]
);

$diContainer = $diBuilder->build();

$tripCalculator = $diContainer->get("Trip\Calculator\TripCalculator");
```

In the above code segment, we're using PHP-DI to autowire the dependencies. We're also configuring which Geo Service API to use.
Above, we're setting the OpenRoute Service. Adding other alternatives is planned future work for the library.


## Usage Instructions
To properly calculate the trip costs, you need to assign the different values.

### Vehicle configurations
```
$vehicle = $tripCalculator->getVehicle();
$vehicle->name = "Vehicle 1";
$vehicle->fuelLitrePerHundred = "9";
$vehicle->wearTearHourly = "5";
```

### Driver configurations
```
$driver = $tripCalculator->getDriver();
$driver->name = "Chris";
$driver->hourlyRate = "10.50";
```

### Trip Configurations
```
$trip = $tripCalculator->getTrip();
$trip->name = "Test trip";

## set the points (coordinates) that need to be included in the trip calculation
$trip->addPoint(new Point(14.4819237, 35.920715));
$trip->addPoint(new Point(14.4526501, 35.9366694));
```

### Calculations
After setting the configurations required for the objects as defined above, you need to then call the calculation process, which will use third party APIs.
```
$totalCost = $tripCalculator->calculateCost();
```

The above will give you the total cost in Euro, but more details are populated in the trip object.
```
$travelledKilometers = $trip->travelledKilometers;
$travelTimeMinutes = $trip->travelTimeMinutes;
$geometryDirections = $tripCalculator->getGeoService()->getDirections();
```


## Third Party Packages
All third party libraries are listed in the composer.json, and have been left as is without modification.

## Requirements
* php 7.4 or above
* ext-decimal / php-decimal
* composer

## Author
Chris Bartolo - chris@chrisbartolo.com

## License 
The Trip Cost Calculator is licenses under the MIT license


