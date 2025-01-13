<?php

namespace App\Services\Sklad\Contracts;

interface ParserInterface
{
    public function parse(string $string): array;
}
