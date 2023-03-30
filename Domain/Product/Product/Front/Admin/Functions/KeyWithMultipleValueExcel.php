<?php

namespace App\Domain\Product\Product\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractUploadFunction;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\ProductKey\Interfaces\ProductKeyInterface;
use App\Domain\Product\ProductKey\Services\ProductKeyProductService;
use Maatwebsite\Excel\Concerns\ToModel;

class KeyWithMultipleValueExcel extends AbstractUploadFunction implements ToModel
{

    function getService(): BaseService
    {
        return ProductKeyProductService::new();
    }

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
                    ],
                $this->parentCounter . \CR::CR . "type" => $row[2]
            ]);
        }
        $this->childCounter++;
        $key = $this->parentCounter . \CR::CR
            . ProductKeyInterface::VALUE
            . \CR::CR . $this->childCounter . \CR::CR;
        $this->deploy = array_merge($this->deploy, [
            $key . "text_ru" => $row[3],
            $key . "text_uz" => $row[4],
        ]);
        return null;
    }
}
