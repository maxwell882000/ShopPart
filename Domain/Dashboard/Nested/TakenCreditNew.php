<?php

namespace App\Domain\Dashboard\Nested;

use App\Domain\Installment\Front\Nested\TakenCreditFiltered;

class TakenCreditNew extends TakenCreditFiltered
{
    function filterByData(): array
    {
        return [
            'new_credit' => true
        ];
    }
}
