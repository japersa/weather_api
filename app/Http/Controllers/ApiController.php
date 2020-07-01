<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    public function showCity($city)
    {
        $client = new \GuzzleHttp\Client();
        $uri = "https://api.mapbox.com/geocoding/v5/mapbox.places";
        $access_token = "pk.eyJ1IjoiamFwZXJzYTkyIiwiYSI6ImNrYnlhMzk1NjB4bjgzMHAzbXc3YWoxbzIifQ.J4iCR7WcneWQne0upHC2Ew";
        $response = $client->request('GET', "{$uri}/{$city}.json?access_token={$access_token}");

        if ($response->getBody()) {
            $body = json_decode($response->getBody());
            return response()->json($body->{'features'});
        } 
    }
    
    public function showWeather($lat, $long)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://api.darksky.net/forecast/88030114c5e47763a011a75e7a10c633/{$lat},{$long}");

        if ($response->getBody()) {
            $body = json_decode($response->getBody());
            return response()->json($body);
        } 
    }
}
