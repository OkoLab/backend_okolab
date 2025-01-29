<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Services\Sklad\Contracts\AgentInterface;

class AgentEntity implements AgentInterface
{
    public function __construct(
        public string $company,
        public string $inn,
        public Address $address,
        public string $contactName,
        public string $phone,
        public string $email
    ) {
    }
}
