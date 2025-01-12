<?php

namespace App\Services\Cdek\Data;

use App\Services\Cdek\Enums\ContragentTypeEnum;

class ContragentData
{
    public function __construct(
        public string $company, // Имя компании
        public string $name, // ФИО контактного лица
        public string $email,
        public string $tin, // ИНН почему-то в документации tin
        public string $phone, // number Должен передаваться в международном формате: код страны (для России +7) и сам номер (10 и более цифр)
        public ContragentTypeEnum $contragentType = ContragentTypeEnum::LEGAL_ENTITY,
    ) {
    }
}
