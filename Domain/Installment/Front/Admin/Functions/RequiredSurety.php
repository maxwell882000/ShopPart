<?php

namespace App\Domain\Installment\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;

//NOTIFICATION FOR USER WHEN IT WAS ACCEPTED !!!!!!!!!!
class RequiredSurety extends AbstractFunction
{
    const FUNCTION_NAME = "requireSurety";

    public static function requireSurety(BaseEmptyLivewire $livewire)
    {
        $entity = $livewire->entity;
        if (!$entity->isRequiredSurety()) {
            $entity->status = PurchaseStatus::REQUIRED_SURETY + $entity->status;
            $entity->save();
            session()->flash("success", __("Отправлен запрос на поручателя"));
        } else {
            $livewire->addError("surety", __("Уже отправлен запрос на поручателя"));
        }
    }

}
