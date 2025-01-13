<?php

namespace App\Services\Sklad\MoySklad\Parser;

use App\Services\Sklad\Contracts\ParserInterface;
use App\Services\Sklad\MoySklad\Data\CounterpartyData;

class Parser implements ParserInterface
{
    // не забывайте делать валидацию входящей строки
    public function parse(string $input): array
    {
        $input = strtolower($input);
        $cmds = explode(', ', $input);

        $data = [];

        foreach ($cmds as $cmd) {
            // Убираем пробелы
            $cmd = trim($cmd);

            if(!$this->isValidFormat($cmd)) {
                continue;
            }

            // Разделяем по тире
            list($name, $year) = explode('-', $cmd);

            $obj = new CounterpartyData();
            $obj->name = $name;
            $obj->year = $year;
            $data[] = $obj;
        }

        return $data;
    }

    private function isValidFormat($str): bool
    {
        $pattern = '/^\d{1,4}(дпи|аон)-\d{2}$/';
        return preg_match($pattern, $str) === 1;
    }
}
