<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Interfaces;

interface   TableFilterByInterface
{
    public function filterByData(): array;
    public function filterByString():string;
}
