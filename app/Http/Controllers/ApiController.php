<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/search/city/{city}",
     *      description="Return list of cities by search criteria",
     *      @OA\Parameter(
     *          name="city",
     *          description="city name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="List of cities",
     *       ),
     * )
     */
    public function showCity($city)
    {
        $client = new \GuzzleHttp\Client();
        $uri = env('API_MAPBOX');
        $access_token = env('ACCESS_TOKEN_MAPBOX');
        $response = $client->request('GET', "{$uri}/{$city}.json?access_token={$access_token}");

        if ($response->getBody()) {
            $body = json_decode($response->getBody());
            return response()->json($body->{'features'});
        } 
    }
    
        /**
     * @OA\Get(
     *      path="/api/weather/{lat}/{long}",
     *      description="Returns information weather of a city by latitude and longitude",
     *      @OA\Parameter(
     *          name="lat",
     *          description="latitud",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),*     
     *      @OA\Parameter(
     *          name="long",
     *          description="longitude",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Return weather information",
     *       ),
     * )
     */
    public function showWeather($lat, $long)
    {
        $client = new \GuzzleHttp\Client();
        $uri = env('API_DARKSKY');
        $response = $client->request('GET', "{$uri}/{$lat},{$long}");

        if ($response->getBody()) {
            $body = json_decode($response->getBody());
            return response()->json($body);
        } 
    }
}
