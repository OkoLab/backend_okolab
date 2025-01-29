<?php

namespace App\Services\Cdek\Actions;

use App\Services\Cdek\CdekClient;
use App\Services\Cdek\CdekService;
use App\Services\Cdek\Data\OrderData;
use App\Services\Sklad\Contracts\InvoiceInterface;
use App\Services\Cdek\Data\Factory\DataFactory;
use App\Casts\Number\Number;
use App\Services\Cdek\Exceptions\CdekException;

class CreateOrderAction
{
    public function __construct(private CdekService $cdekService) {
    }

    public static function make(CdekService $cdekService): static
    {
        return new static($cdekService);
    }

    public function run(InvoiceInterface $invoiceoutFromSkladEntity): mixed //OrderEntity
    {
        $recipient = DataFactory::createContragentData($invoiceoutFromSkladEntity->agent);
        $to_location = DataFactory::createLocationData($invoiceoutFromSkladEntity->agent);
        $services[] = DataFactory::createServicesData(  new Number($invoiceoutFromSkladEntity->sum));
        $packages = DataFactory::createPackagesData($invoiceoutFromSkladEntity);


        /**
         * @var OrderData $order
         */
        $order = new OrderData(
            $invoiceoutFromSkladEntity->invoice_name,
            $recipient,
            $to_location,
            $packages,
            $invoiceoutFromSkladEntity->comment,
            $services
        );

        $data = json_encode($order);
        $data = json_decode($data, true);
        $response = CdekClient::make($this->cdekService)->post('/orders', $data);

        if (isset($response['requests']['errors'])) {
            throw new CdekException($response['requests']['errors']);
        }

        $response = CdekClient::make($this->cdekService)->get('/orders/' . $response['entity']['uuid']);

        if (isset($response['requests']['errors'])) {
            throw new CdekException($response['requests']['errors']);
        }

        return $response;
    }
}
