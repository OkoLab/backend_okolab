<?php

namespace App\Services\Cdek\Entities;

class Order
{
    public function __construct(
        public int $type = 1, // 1 - "интернет-магазин" (только для договора типа "Договор с ИМ")
        public int $tariff_code = 137, // Посылка склад-дверь
        public string $comment, // string(255)
        public string $shipment_point, // TODO УКАЗАТЬ Код ПВЗ СДЭК, на который будет производиться самостоятельный привоз клиентом

    ) {}

}
