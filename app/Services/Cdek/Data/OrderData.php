<?php

namespace App\Services\Cdek\Data;

class OrderData
{
    public function __construct(
        public readonly string $number,
        public readonly ContragentData $recipient,
        public readonly LocationData $to_location,
        public array $packages = [],
        public string $comment, // string(255)
        public mixed $services,
        public readonly int $type = 1, // 1 - "интернет-магазин"
        public readonly int $tariff_code = 137, // Посылка склад-дверь
        public string $shipment_point = 'MSK26', // TODO УКАЗАТЬ Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом
    ) {}

}
