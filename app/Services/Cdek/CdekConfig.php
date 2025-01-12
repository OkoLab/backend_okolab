<?php

namespace App\Services\Cdek;

class CdekConfig
{
    function __construct(
        public readonly string $login,
        public readonly string $password,
        public readonly string $url
    ) {
    }

}
