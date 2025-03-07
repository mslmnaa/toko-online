<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $originCity;

    public function __construct()
    {
        $this->apiKey = config('rajaongkir.api_key');
        $this->baseUrl = config('rajaongkir.base_url');
        $this->originCity = config('rajaongkir.origin_city');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/province');

        Log::info('RajaOngkir Provinces Response: ' . json_encode($response->json()));

        return $response->json()['rajaongkir']['results'] ?? [];
    }

    public function getCities($provinceId = null)
    {
        $params = $provinceId ? ['province' => $provinceId] : [];
        
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/city', query: $params);

        Log::info('RajaOngkir Cities Response: ' . json_encode($response->json()));

        return $response->json()['rajaongkir']['results'] ?? [];
    }

    public function calculateShipping($destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . '/cost', [
            'origin' => $this->originCity,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        Log::info('RajaOngkir Shipping Cost Response: ' . json_encode($response->json()));

        return $response->json()['rajaongkir']['results'][0]['costs'] ?? [];
    }
}