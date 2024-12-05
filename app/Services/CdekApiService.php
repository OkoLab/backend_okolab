<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\PendingRequest;
use App\Services\CalculateItemDimensions;
use Illuminate\Support\Facades\Log;
use App\Models\DevicesBoxSize;
use App\Types\Parcel;
use Exception;
use Illuminate\Http\JsonResponse;

class CdekApiService
{
    private $token;

    public function __construct(protected CalculateItemDimensions $calculateItemDimensions)
    {
        $this->token = $this->getNewToken();
        $this->calculateItemDimensions = $calculateItemDimensions;
    }

    public function getNewToken()
    {
        try {
            $response = Http::asForm()->post(env('CDEK_CLIENT') . '/oauth/token?parameters', [
                'grant_type' => 'client_credentials',
                'client_id' => env('CDEK_CLIENT_ID'),
                'client_secret' => env('CDEK_CLIENT_SECRET')
            ]);

            return $response['access_token'];
        } catch (Exception $e) {
            throw new Exception("Can't get access token to CDEK service!");
        }
    }

    public function locationSuggestCities(string $name)
    {
        try {
            $response = Http::withToken($this->token)->retry(2, 0, function (Exception $exception, PendingRequest $request) {

                if (!$exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken($this->getNewToken());
                return true;

            })->get(env('CDEK_CLIENT') . '/location/suggest/cities', [
                        'name' => $name,
                        'country_code' => 'RU'
                    ]);

            info($response);
            return $response;
        } catch (Exception $e) {
            throw new Exception("Can't get cities suggest from CDEK service!");
        }
    }

    public function calculatorTariff(Request $request)
    {
        list($deviceAmount, $locations, $cost_sum) = $this->splitDeviceAmountAndLocations($request->all());

        /**
         * @var Parcel $parcel
         */
        $parcel = $this->calculateItemDimensions->getTotalDimensions($deviceAmount);
        $some_packages = [];

        for ($i = 0; $i < $parcel->number; $i++) {
            $package = [];
            $package['length'] = $parcel->length;
            $package['width'] = $parcel->width;
            $package['height'] = $parcel->height;
            $package['weight'] = $parcel->weight;
            $some_packages[] = $package;
        }

        try {
            $response = Http::withToken($this->token)->retry(2, 0, function (Exception $exception, PendingRequest $request) {

                if (!$exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken($this->getNewToken());
                return true;

            })->post(env('CDEK_CLIENT') . '/calculator/tariff', [
                        'type' => 1,
                        'tariff_code' => 139, // Посылка дверь-дверь
                        'from_location' => [
                            "code" => $locations['location_from']
                        ],
                        'to_location' => [
                            "code" => $locations['location_to']
                        ],
                        "packages" => $some_packages,
                        'services' => [
                            [
                                "code" => "INSURANCE",
                                "parameter" => $cost_sum
                            ]
                        ],
                    ]);
            info($response);
            return $response;
        } catch (Exception $e) {
            throw new Exception("Can't get cities suggest from CDEK service!");
        }
    }


    private function splitDeviceAmountAndLocations($original): array
    {
        $deviceAmount = [];
        $locations = [];
        $cost_sum = 0;

        foreach ($original as $key => $value) {
            if ('location_to' === $key || 'location_from' === $key) {
                $locations[$key] = $value;
            } else {
                $deviceAmount[$key] = $value;
                $deviceBoxSize = DevicesBoxSize::where('article', $key)->first();
                if ($deviceBoxSize) {
                    $cost_sum += $deviceBoxSize->cost * $value;
                }
            }
        }

        return [$deviceAmount, $locations, $cost_sum];
    }
}
