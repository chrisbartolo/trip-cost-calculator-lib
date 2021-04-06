<?php

namespace Trip\Calculator\Services;

use GuzzleHttp\Client;
use Trip\Calculator\Interfaces\GeoService;
use Trip\Calculator\Objects\Point;
use Trip\Calculator\Objects\Trip;

class OpenRoute implements GeoService
{
    private $apiKey;
    public int $travelledKilometers = 0;
    public int $travelTimeMinutes = 0;
    private Client $guzzleClient;
    private array $directions;

    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey;

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

    public function fetchDirectionsFromApi(Trip $trip): void
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
        $this->directions = \GeometryLibrary\PolyUtil::decode($result->routes[0]->geometry);
    }

    public function getDirections(): array
    {
        return $this->directions;
    }

    public function getCoordinatesFromAddress(string $address): Point
    {
        $request = $this->guzzleClient->request(
            'GET',
            'https://api.openrouteservice.org/geocode/search', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'text' => $address,
                    'layers' => 'address'
                ]
            ]
        );

        $result = json_decode($request->getBody()->getContents());

        return new Point($result->features[0]->geometry->coordinates[1], $result->features[0]->geometry->coordinates[0]);
    }

    public function getAddressFromCoordinates(Point $point): string
    {
        $request = $this->guzzleClient->request(
            'GET',
            'https://api.openrouteservice.org/geocode/reverse', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'point.lon' => $point->longitude,
                    'point.lat' => $point->latitude,
                    'layers' => 'street'
                ]
            ]
        );

        $result = json_decode($request->getBody()->getContents());

        return $result->features[0]->properties->label;

    }

    public function getTravelledKilometers(): int
    {
        return $this->travelledKilometers;
    }

    public function getTravelTimeMinutes(): int
    {
        return $this->travelTimeMinutes;
    }
}