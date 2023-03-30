<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Interfaces;


use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\AbstractAttributes;

interface TableInterface
{
    const TABLE_COMPONENT = "<x-helper.table.table :table='%s' />";

    // ordering is important
    public function getColumns(): array;

}
