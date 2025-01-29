<?php

namespace App\Services\Cdek\Data;

class ItemsData
{
    public function __construct(
        public readonly string $name, // Наименование товара (может также содержать описание товара: размер, цвет)
        public readonly int $amount, // Количество единиц товара (в штуках)
        public readonly float $cost,
        public readonly float $weight,
        public readonly string $ware_key='*',
        //Оплата за товар при получении (за единицу товара в валюте страны
        // получателя, значение >=0) — наложенный платеж,
        //в случае предоплаты значение = 0
        public readonly MoneyData $payment = new MoneyData(),
    ) {
    }
}
