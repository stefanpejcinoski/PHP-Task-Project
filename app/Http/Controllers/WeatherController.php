<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    public function getWeatherFromAPI(City $city)
    {
        $name = $city->name;
        $api = env('API_URL');
        $api_key = env('API_KEY');
        $units = env('API_UNITS');
        $data = Http::get("{$api}?q={$name}&appid={$api_key}&units={$units}")->json();
        $weather_description = $data['weather'][0]['description'];
        $temp = $data['main']['temp'];
        $humidity = $data['main']['humidity'];

        $weather = new Weather([
            'temperature' => $temp,
            'humidity' => $humidity,
            'weather_description' => $weather_description,
            'city_id' => $city->id
        ]);
        $weather->save();
    }
    public function index()
    {
        $weather = Weather::all();
        return response()->json($weather, 200);
    }

    public function start()
    {

    }

    public function stop()
    {

    }

}
