<?php

namespace App\Services\Cdek\Data;

class ServicesData
{
    public function __construct(
        public readonly string $code,
        public readonly string $parameter
    ) {}
}
