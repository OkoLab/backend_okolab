<?php

namespace App\Services\Sklad;

use App\Services\Sklad\MoySklad\MoySkladService;
use App\Services\Sklad\Contracts\ParserInterface;
use Dotenv\Parser\Parser;

class SkladService
{
    public function __construct(MoySkladService $moySkladService, ParserInterface $parser) {

    }

}
