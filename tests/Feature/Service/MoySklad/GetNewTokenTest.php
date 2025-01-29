<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Sklad\MoySklad\MoySkladClient;
use Tests\TestCase;

class GetNewTokenTest extends TestCase
{
    public function test_get_new_token(): void
    {
        $response = (new MoySkladClient($this->moySkladService))->getNewToken();
        dd($response);
    }
}
