<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function showTrunyanWeather()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        
        // Koordinat Bukit Trunyan
        $lat = "-8.2530"; 
        $lon = "115.4301";

        // Mengambil data dari API
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $apiKey,
            'units' => 'metric', // Biar suhu Celcius
            'lang' => 'id'       // Bahasa Indonesia
        ]);

        if ($response->successful()) {
            $weather = $response->json();
            return view('virtual_tour', compact('weather'));
        }

        return "Gagal memuat data cuaca.";
    }
}
