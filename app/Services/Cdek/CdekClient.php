<?php

namespace App\Services\Cdek;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use App\Services\Cdek\Exceptions\InvalidTokenException;
use Illuminate\Http\Client\RequestException;
use App\Services\Cdek\Exceptions\CdekException;
use Exception;

class CdekClient
{
    private string $token;

    public function __construct(private readonly CdekService $cdekService)
    {

    }

    public static function make(CdekService $cdekService): static
    {
        return new static($cdekService);
    }

    public function client(): PendingRequest
    {
        return Http::baseUrl($this->cdekService->config->url);
    }

    private function getToken(): string
    {
        if (!isset($this->token)) {
            $this->getNewToken();
        }
        return $this->token;
    }

    public function getNewToken()
    {
        $response = $this->client()->asForm()->post('/oauth/token?parameters', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->cdekService->config->login,
            'client_secret' => $this->cdekService->config->password
        ]);

        if (!isset($response['access_token'])) {
            throw new InvalidTokenException("Can't get access token to Cdek service!");
        }

        return $this->token = $response['access_token'];
    }

    private function withToken(): PendingRequest
    {
        return $this->client()->withToken($this->getToken())->retry(2, 0, function (Exception $exception, PendingRequest $request) {

            if (!$exception instanceof RequestException || $exception->response->status() !== 401) {
                return false;
            }
            $request->withToken($this->getNewToken());
            return true;

        });
    }

    public function get(string $url): array
    {
        try {
            $response = $this->withToken()->get($url);
            return $response->json();

        } catch (Exception $e) {
            throw new CdekException($e->getMessage());
        }
    }

    public function post(string $url, array $data): array
    {
        try {
            $response = $this->withToken()->post($url, $data);
            return $response->json();

        } catch (Exception $e) {
            throw new CdekException($e->getMessage());
        }
    }
}
