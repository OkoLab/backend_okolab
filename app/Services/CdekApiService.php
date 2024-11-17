<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\PendingRequest;
use Exception;

class CdekApiService
{
    private $token;

    public function __construct()
    {
        $this->token = $this->getNewToken();
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

    public function locationSuggestCities($name)
    {
        try {
            $response = Http::withToken($this->token)->retry(2, 0, function (Exception $exception, PendingRequest $request) {

                if (!$exception instanceof RequestException || $exception->response->status() !== 401) {
                    return false;
                }
                $request->withToken($this->getNewToken());
                return true;

            })->get(env('CDEK_CLIENT') . '/location/suggest/cities', [
                        'name' => $name
                    ]);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Can't get cities suggest from CDEK service!");
        }
    }
}
