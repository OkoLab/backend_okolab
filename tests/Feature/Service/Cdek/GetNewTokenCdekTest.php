<?php

namespace Tests\Feature\App\tests\Feature\Service\Cdek;

use App\Services\Cdek\CdekService;
use App\Services\Cdek\CdekClient;
use App\Services\Cdek\CdekConfig;
use Tests\TestCase;

class GetNewTokenCdekTest extends TestCase
{

    public function test_getNewToken(): void
    {
        $response = (new CdekClient($this->cdekService))->getNewToken();
        dd($response);
    }
}
