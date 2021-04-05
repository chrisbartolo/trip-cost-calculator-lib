<?php

namespace Trip\Calculator\Services;

use GuzzleHttp\Client;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

class OpenRoute implements GeoService
{
    public int $travelledKilometers = 0;
    public int $travelTimeMinutes = 0;
    private Client $guzzleClient;

    public function __construct($apiKey = null)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $apiKey
        ];

        $this->guzzleClient = new Client(
            [
                'headers' => $headers
            ]
        );
    }

    public function getDirections(Trip $trip)
    {
        $body = array();
        $body['coordinates'] = $trip->getPointsAsCoordinates();
        $body['maximum_speed'] = (int)80;

        $request = $this->guzzleClient->request(
            'POST',
            'https://api.openrouteservice.org/v2/directions/driving-car',
            ['body' => json_encode($body)]
        );

        $result = json_decode($request->getBody()->getContents());

        $this->travelledKilometers = $result->routes[0]->summary->distance / 1000;
        $this->travelTimeMinutes = $result->routes[0]->summary->duration / 60;
    }

    public function getCoordinatesFromAddress(string $address)
    {
        // TODO: Implement getCoordinatesFromAddress() method.
    }

    public function getAddressFromCoordinates(Point $point)
    {
        // TODO: Implement getAddressFromCoordinates() method.
    }

    public function getTravelledKilometers()
    {
        return $this->travelledKilometers;
    }

    public function getTravelTimeMinutes()
    {
        return $this->travelTimeMinutes;
    }
}