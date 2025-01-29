<?php

namespace App\Services\Cdek\Data;

class SellerData
{
    public function __construct(
        public string $name,
        public string $inn, // ИНН
        public string $phone, // Должен передаваться в международном формате: код страны (для России +7) и сам номер (10 и более цифр)
    ) {}
}
