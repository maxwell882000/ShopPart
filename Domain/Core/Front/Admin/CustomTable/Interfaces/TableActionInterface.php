<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Interfaces;

interface TableActionInterface extends TableClassInterface
{
    public function getActionsAttribute(): string;

}
