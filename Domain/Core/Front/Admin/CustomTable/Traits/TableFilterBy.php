<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

//used with combination  TableFilterByInterface and ArrayHandle
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Main\Traits\ArrayHandle;

trait TableFilterBy
{
    use ArrayHandle, AttributeGetVariable;
    public function filterByString(): string
    {
        return ":filterBy=" . $this->arrayToString($this->filterByData());
    }
    abstract public function filterByData():array;
}
