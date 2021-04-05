<?php

namespace Trip\Calculator\Services;

use GuzzleHttp\Client;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Trip;
use Trip\Calculator\Objects\Point;

class OpenRoute implements GeoService
{
    private \GuzzleHttp\Client $guzzleClient;

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
        $body['maximum_speed'] = (int) 80;

        $request = $this->guzzleClient->request(
            'POST',
            'https://api.openrouteservice.org/v2/directions/driving-car',
            ['body' => json_encode($body)]
        );

        return json_decode($request->getBody()->getContents());
    }

    public function getCoordinatesFromAddress(string $address)
    {
        // TODO: Implement getCoordinatesFromAddress() method.
    }

    public function getAddressFromCoordinates(Point $point)
    {
        // TODO: Implement getAddressFromCoordinates() method.
    }
}