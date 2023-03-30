<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;

use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseTable implements TableInterface, LivewireAdditionalFunctions, HtmlInterface
{
    public $columns;
    public $list;
    public $paginate;

    public function __construct($entities = [])
    {
        $this->list = $entities;
        $this->paginate = $entities;
        $this->columns = $this->getColumns();
    }

    public function generateFunctions(): string
    {
        $str_functions = "";
        foreach ($this->getColumns() as $item) {
            $str_functions = $str_functions . " " . $item->generateFunction();
        }
        return $str_functions;
    }

    public function generateHtml(): string
    {
        return sprintf('<x-%s :table="$table" :optional="$optional" %s>
        %s </x-%s>', $this->pathToBlade(), $this->setTurnOff(), $this->slot(), $this->pathToBlade());
    }

    protected function pathToBlade(): string
    {
        return "helper.table.table";
    }

    private function setTurnOff(): string
    {
        if ($this->turnOffActions())
            return sprintf('turn_off="%s"', $this->turnOffActions());
        return "";
    }

    public function turnOffActions(): string
    {
        return "";
    }

    public function slot(): string
    {
        return "";
    }

    public function isCreate()
    {
        return false;
    }

}
