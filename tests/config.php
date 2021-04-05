<?php
// config.php
return [
    // ...
    \Trip\Calculator\Interfaces\GeoService::class => DI\create()
        ->constructor(DI\get(\Trip\Calculator\Services\GoogleMaps::class))
];