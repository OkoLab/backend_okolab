<?php

namespace App\Services\Cdek\Data;

class CreateOrderData
{
    public function __construct(
        public readonly int $type,
        public readonly int $tariff_code,
        public readonly ContragentData $sender,
        public readonly SellerData $seller,
        public readonly ContragentData $recipient,
        public readonly LocationData $from_location,
        public readonly LocationData $to_location,
        public readonly ServicesData $services,
        public readonly array $packages = []
    ) {}

}
