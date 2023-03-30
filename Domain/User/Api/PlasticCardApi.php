<?php

namespace App\Domain\User\Api;

use App\Domain\User\Entities\PlasticCard;

class PlasticCardApi extends PlasticCard
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "pan" => $this->pan,
            "expiry" => $this->expiry,
            "card_holder" => $this->card_holder
        ];
    }
}
