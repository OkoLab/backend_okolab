<?php

namespace App\Services\Sklad\MoySklad\Actions;

use App\Casts\Number\Number;
use App\Services\Sklad\MoySklad\MoySkladService;
use App\Services\Sklad\MoySklad\MoySkladClient;
use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\Exceptions\MoySkladException;
use App\Services\Sklad\MoySklad\Entities\ProductColletion;
use App\Services\Sklad\MoySklad\Entities\Address;
use App\Services\Sklad\MoySklad\Entities\InvoiceoutEntity;
use App\Services\Sklad\MoySklad\Entities\ProductEntity;
use App\Services\Sklad\MoySklad\Entities\AgentEntity;

use Exception;

class GetInvoiceoutAction
{
    private InvoiceoutEntity $invoiceoutEntity;
    private array $invoiceResponse;

    public function __construct(private MoySkladService $moySkladService)
    {
    }

    public static function make(MoySkladService $moySkladService): static
    {
        return new static($moySkladService);
    }

    public function findInvoiceByName(InvoiceData $invoiceData): static
    {
        try {
            $response = MoySkladClient::make($this->moySkladService)
                ->get('/entity/invoiceout', [
                    'filter' =>
                        'name=' . $invoiceData->name . ';updated>=' . $invoiceData->year . '-01-01 00:00:00;updated<' . ($invoiceData->year + 1) . '-01-01 00:00:00;',
                ]);

            if ((empty($response['rows']) || $response["meta"]['size'] == 0)) {
                throw new MoySkladException("Can't get invoiceout to Sklad\MoySklad service!");
            }

            $this->invoiceResponse = $response['rows'][0];

            return $this;
        } catch (Exception $e) {
            throw new MoySkladException("Don't find invoiceout to Sklad\MoySklad service!");
        }
    }

    public function getInvoice(): static
    {
        if (empty($this->invoiceResponse)) {
            throw new MoySkladException("Don't find invoiceout to Sklad\MoySklad service!");
        }
        $this->invoiceoutEntity = new InvoiceoutEntity();
        $this->invoiceoutEntity->id = $this->invoiceResponse["id"];
        $this->invoiceoutEntity->invoice_name = $this->invoiceResponse["name"];
        $this->invoiceoutEntity->comment = $this->invoiceResponse["description"] ?? '';
        $this->invoiceoutEntity->sum = new Number($this->invoiceResponse["sum"]);

        return $this;
    }

    public function getAgent(): static
    {
        if(isset($this->invoiceoutEntity) && empty($this->invoiceResponse)) {
            throw new MoySkladException("Don't find invoiceout to Sklad\MoySklad service!");
        }

        $agentHref = $this->invoiceResponse["agent"]["meta"]["href"];
        $response = MoySkladClient::make($this->moySkladService)->get($agentHref, []);

        $address = new Address(
            // удаляем из города все до заглавной буквы
            city: preg_replace('/^[^A-ZА-Я]*(.*)$/u', '$1', $response["legalAddressFull"]["city"]),
            street: $response["legalAddressFull"]["street"],
            house: $response["legalAddressFull"]["house"],
            apartment: $response["legalAddressFull"]["apartment"] ?? '',
        );

        $this->invoiceoutEntity->agent = new AgentEntity(
            company: $response['name'],
            inn: $response["inn"],
            address: $address,
            contactName: $response["actualAddressFull"]["comment"] ?? '',
            phone: $response["phone"],
            email: $response["email"] ?? '',
        );

        return $this;
    }

    public function getAssortiments(): static
    {
        try {

            if(isset($this->invoiceoutEntity) && empty($this->invoiceResponse)) {
                throw new MoySkladException("Don't find invoiceout to Sklad\MoySklad service!");
            }

            $response = MoySkladClient::make($this->moySkladService)
                ->get('/entity/invoiceout/' . $this->invoiceoutEntity->id, [
                    'expand' => 'positions.assortment',
                ]);

            $productCollection = new ProductColletion();

            // TODO : discount не учитывается
            foreach ($response['positions']['rows'] as $position) {
                $product = new ProductEntity(
                    id: $position['assortment']['id'],
                    name: $position['assortment']['name'],
                    quantity: new Number($position['quantity']),
                    price: new Number($position['price']),
                    code: $position['assortment']['code'] ?? '',
                    pathName: $position['assortment']['pathName'] ?? '',
                );
                $productCollection->addProduct($product);
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
