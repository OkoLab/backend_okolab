<?php

namespace App\Services\MoySklad\Parser;

use App\Services\MoySklad\Parser\IParser;
use App\Services\MoySklad\Data\CounterpartyData;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class Parser implements IParser
{
    // не забывайте делать валидацию входящей строки
    public function parseFromString(string $inputString): Collection
    {
        $inputString = strtolower($inputString);
        $cmds = explode(',', $inputString);

        return collect($cmds)
            ->map(function (string $cmd) {

                $cmd = trim($cmd);

                if (empty($cmd) || !preg_match('/^\d{1,4}(дпи|аон)-\d{2}$/', $cmd)) {
                    throw new InvalidArgumentException("Неверный формат строки.");
                }

                list($name, $year) = explode('-', $cmd);

                return new CounterpartyData($name, '20'.$year);
            });
    }
}
