<?php

namespace App\Domain\CreditProduct\Api;

use App\Domain\CreditProduct\Entity\MainCredit;

class MainCreditProductApi extends MainCredit
{
    public function toArray()
    {
        return [
            'id' => $this->id,
            "initial_percent" => $this->initial_percent,
            "name" => $this->getNameCurrentAttribute(),
            'helper_text' => $this->getHelperTextCurrentAttribute(),
            "credits" => $this->credits()->orderBy("month")->get()
        ];
    }
}
