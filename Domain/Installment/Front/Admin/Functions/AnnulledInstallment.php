<?php

namespace App\Domain\Installment\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;

class AnnulledInstallment extends AbstractFunction
{
    const FUNCTION_NAME = "annulling";

    static public function annulling(BaseEmptyLivewire $livewire)
    {
        $entity = $livewire->entity;
        $entity->status = PurchaseStatus::ANNULLED;
        $entity->save();
    }
}
