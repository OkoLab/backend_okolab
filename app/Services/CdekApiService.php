<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class CdekApiService
{
    private $token;

    public function __construct() {
        $this->token = $this->Authorization();
    }

    public function Authorization(): string
    {
        $response = Http::asForm()->post(env('CDEK_CLIENT'), [
            'grant_type' => 'client_credentials',
            'client_id' => env('CDEK_CLIENT_ID'),
            'client_secret' => env('CDEK_CLIENT_SECRET')
        ]);

        return $response['access_token'];
    }
}
