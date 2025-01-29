<?php

namespace App\Services\Cdek\Data\Factory;

use App\Services\Sklad\Contracts\AgentInterface;
use App\Services\Cdek\Data\ContragentData;
use App\Services\Cdek\Data\LocationData;
use App\Services\Cdek\Data\ServicesData;
use App\Services\Sklad\Contracts\InvoiceInterface;
use App\Services\Cdek\Data\PackageData;
use App\Casts\Number\Number;

abstract class AbstractDataFactory
{
    abstract static public function createContragentData(AgentInterface $agent): ContragentData;
    abstract static public function createLocationData(AgentInterface $agent): LocationData;
    abstract static public function createServicesData(Number $sum): ServicesData;

    /**
     * @param InvoiceInterface $invoiceoutEntity
     * @return PackageData[]
     */
    abstract static public function createPackagesData(InvoiceInterface $invoiceout): array;
}
