<?php

namespace App\Services\Cdek\Data;

class ServicesData
{
    public function __construct(
        private readonly int $code,
        private readonly string $parameter
    ) {}
}
