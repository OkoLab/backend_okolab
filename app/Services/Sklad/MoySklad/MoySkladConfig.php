<?php

namespace App\Services\Sklad\MoySklad;

class MoySkladConfig
{
    public readonly string $url;

    function __construct(
        public readonly string $login,
        public readonly string $password,
    ) {
       $this->url = 'https://api.moysklad.ru/api/remap/1.2';
    }
}
