<?php

namespace App\Services\Cdek\Data\Factory;

use App\Casts\Number\Number;
use App\Services\Cdek\Data\PhoneData;
use App\Services\Sklad\Contracts\AgentInterface;
use App\Services\Sklad\Contracts\InvoiceInterface;
use App\Services\Cdek\Data\ContragentData;
use App\Services\Cdek\Data\LocationData;
use App\Services\Cdek\Data\ServicesData;
use App\Services\Cdek\Data\ItemsData;
use App\Services\Cdek\Data\PackageData;
use App\Services\Dimension\Actions\CalculateParcel;
use App\Services\Dimension\Entities\Parcel;
use App\Support\Converter;

class DataFactory extends AbstractDataFactory
{
    public static function createContragentData(AgentInterface $agent): ContragentData
    {
        $number = new PhoneData($agent->phone);
        $phones[] = $number;

        return new ContragentData(
            $agent->company,
            $agent->inn,
            $agent->contactName,
            $agent->email,
            $phones
        );
    }

    public static function createLocationData(AgentInterface $agent): LocationData
    {
        $address = $agent->address->street . ', ' . $agent->address->house . ', ' . $agent->address->apartment;
        return new LocationData(
            $agent->address->city,
            $address
        );
    }

    public static function createServicesData(Number $sum): ServicesData
    {
        return new ServicesData('INSURANCE', Converter::kopeikiToRuble($sum)->value());
    }

    /**
     * @param InvoiceInterface $invoiceout
     * @return PackageData[]
     */
    public static function createPackagesData(InvoiceInterface $invoiceout): array
    {
        /**
         * @var Parcel
         */
        $parcel = CalculateParcel::make()->run($invoiceout->positions);

        $packages = [];
        for ($index = 0; $index < $parcel->number->value(); $index++) {
            $item[] = new ItemsData(
                $name = 'Оборудование для системы вызова персонала по счету ' . $invoiceout->invoice_name,
                $quantity = 1,
                // переводим в рубли
                $cost = Converter::kopeikiToRuble($invoiceout->sum)->floatValue(),
                $weight = $parcel->weight->floatValue()
            );


            $packages[] = new PackageData(
                $invoiceout->invoice_name,
                $weight = $parcel->weight->intValue(),
                //переводим мм в сантиметры
                $length = Converter::mmToCm($parcel->length)->intValue(),
                $width = Converter::mmToCm($parcel->width)->intValue(),
                $height = Converter::mmToCm($parcel->height)->intValue(),
                $items = $item
            );
        }
        return $packages;
    }
}
