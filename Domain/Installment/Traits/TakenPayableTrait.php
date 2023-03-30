<?php

namespace App\Domain\Installment\Traits;

use App\Domain\Core\Api\CardService\Traits\HasTransaction;
use Illuminate\Support\Collection;

trait TakenPayableTrait
{
    use HasTransaction;

    public function amount()
    {
        return $this->initial_price;
    }

    public function account_id()
    {
        return $this->id;
    }

    public function getTokens(): Collection
    {
        return $this->getPlasticTokens();
    }

    public function finishTransaction(array $confirm): bool
    {
        //write logic to finish transaction
        // check confirm is everything exists and etc
        return true;
    }

    public function taken_id()
    {
        return $this->id;
    }

    public function check(): bool
    {
        return $this->transaction_id == null;
    }
}
