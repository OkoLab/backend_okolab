<?php

namespace App\Services\Sklad\MoySklad;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\RequestException;
use App\Services\Sklad\MoySklad\Exceptions\InvalidTokenException;
use Exception;


class MoySkladClient
{
    private string $token;

    public function __construct(private readonly MoySkladService $moySkladService)
    {

    }

    public static function make(MoySkladService $moySkladService): static
    {
        return new static($moySkladService);
    }

    private function client(): PendingRequest
    {
        return Http::withHeaders([
            'Accept-Encoding' => 'gzip',
        ])->baseUrl($this->moySkladService->config->url);
    }

    private function getToken(): string
    {
        if (!isset($this->token)) {
            $this->getNewToken();
        }
        return $this->token;
    }

    private function getNewToken(): string
    {
        $response = $this->client()
            ->withBasicAuth(
                $this->moySkladService->config->login,
                $this->moySkladService->config->password
            )
            ->post('/security/token');

        if (!isset($response['access_token'])) {
            throw new InvalidTokenException("Can't get access token to MoySklad service!");
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

    public function post(string $url, array $data): array
    {

        $response = $this->withToken()->post($url, $data);

        $response = $response->json();

        // if ($response['Success'] === false) {
        //     throw new TinkoffException($response['Details']);
        // }

        return $response;
    }

    public function get(string $url, array $data): array
    {
        $response = $this->withToken()->get($url, $data);

        return $response->json();
    }
}

