<?php

namespace App\Domain\Product\Product\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractUploadFunction;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\HeaderText\Interfaces\HeaderKeyInterface;
use App\Domain\Product\HeaderText\Services\HeaderTextService;

class HeaderTextExcelFunction extends AbstractUploadFunction
{
    public function model(array $row)
    {
        if ($row[0] and $row[1]) {
            $this->parentCounter++;
            $this->childCounter = 0;
            $this->deploy = array_merge($this->deploy, [
                $this->parentCounter . \CR::CR . "text" =>
                    [
                        "ru" => $row[0],
                        "uz" => $row[1]
                    ]
            ]);
        }

        $this->childCounter++;
        $key = $this->parentCounter . \CR::CR
            . HeaderKeyInterface::KEY_VALUE_SERVICE
            . \CR::CR . $this->childCounter . \CR::CR;
        $this->deploy = array_merge($this->deploy, [
            $key . "key_ru" => $row[2],
            $key . "key_uz" => $row[3],
            $key . "value_ru" => $row[4],
            $key . "value_uz" => $row[5]
        ]);

        return null;
    }

    function getService(): BaseService
    {
        return HeaderTextService::new();
    }
}
