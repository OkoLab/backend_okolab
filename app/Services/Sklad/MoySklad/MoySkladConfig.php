<?php

namespace App\Services\Sklad\MoySklad;

class MoySkladConfig
{
    function __construct(
        public readonly string $login,
        public readonly string $password,
        public readonly string $url
    ) {}
}
