<?php

namespace App\Services\MoySklad\Actions;

use App\Services\MoySklad\Data\CounterpartyData;
use App\Services\MoySklad\Data\ContactInformationString;
use App\Services\MoySklad\Entities\InvoiceoutEntity;
use App\Services\MoySklad\MoySkladService;
use App\Services\MoySklad\MoySkladClient;
use App\Services\MoySklad\Entities\ProductColletion;
use App\Services\MoySklad\Entities\ProductEntity;
use App\Services\MoySklad\Exceptions\MoySkladException;
use Exception;

class GetInvoiceoutAction
{
    private InvoiceoutEntity $invoiceoutEntity;

    public function __construct(private MoySkladService $moySkladService)
    {
    }

    public static function make(MoySkladService $moySkladService): static
    {
        return new static($moySkladService);
    }

    public function findByName(CounterpartyData $counterpartyData): static
    {
        try {
            $response = MoySkladClient::make($this->moySkladService)
                ->get('/entity/invoiceout', [
                    'filter' =>
                        'name=' . $counterpartyData->name . ';updated>=' . $counterpartyData->year . '-01-01 00:00:00;updated<' . ($counterpartyData->year + 1) . '-01-01 00:00:00;updated<20' . $counterpartyData->year . '-01-01 00:00:00',
                ]);

            if ((empty($response['rows']) || $response["meta"]['size'] == 0)) {
                throw new MoySkladException("Can't get invoiceout to Sklad\MoySklad service!");
            }

            $this->invoiceoutEntity = new InvoiceoutEntity();
            $this->invoiceoutEntity->id = $response['rows'][0]['id'];
            $this->invoiceoutEntity->name = $response['rows'][0]["name"];
            $this->invoiceoutEntity->contactInformation = new ContactInformationString(
                $response['rows'][0]["description"],
            );

            return $this;
        } catch (Exception $e) {
            throw new MoySkladException("Don't find invoiceout to Sklad\MoySklad service!");
        }

    }

    public function getAssortiments(): static
    {
        try {
            $response = MoySkladClient::make($this->moySkladService)
                ->get('/entity/invoiceout/' . $this->invoiceoutEntity->id, [
                    'expand' => 'positions.assortment',
                ]);

            $productCollection = new ProductColletion();

            // TODO : discount не учитывается
            foreach ($response['positions']['rows'] as $position) {
                $productCollection->addProduct(new ProductEntity(
                    id: $position['assortment']['id'],
                    name: $position['assortment']['name'],
                    quantity: $position['quantity'],
                    price: $position['price'],
                    code: $position['assortment']['code'] ?? '',
                    pathName: $position['assortment']['pathName'] ?? '',
                ));
            }

            $this->invoiceoutEntity->positions = $productCollection;

            return $this;
        } catch (Exception $e) {
            throw new MoySkladException("Can't get invoiceout to Sklad\MoySklad service!");
        }
    }

    public function run(): InvoiceoutEntity
    {
        return $this->invoiceoutEntity;
    }
}
