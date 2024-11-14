<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class CdekApiService
{
    public function Authorization(): Response
    {
        $response = Http::withHeaders([
            'grant_type' => 'client_credentials',
        ])->post(env('CDEK_CLIENT'), [
                    'client_id' => env('CDEK_CLIENT_ID'),
                    'client_secret' => env('CDEK_CLIENT_SECRET')
                ]);

        return $response;
    }
}
