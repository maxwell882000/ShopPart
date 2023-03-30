<?php

namespace App\Domain\Core\Main\Traits;

use Illuminate\Support\Facades\Log;

trait HasPrice
{
    public function getPriceShowAttribute(): string
    {
        return $this->formatPrice($this->price);
    }

    protected function formatPrice($price)
    {
        Log::error($price);
        $price = strval($price);
        if ($price != null && strlen($price) > 3 && $price[-3] === ".") {
            $remainder = substr($price, -2) % 1;
            $full_part = substr($price, 0, strlen($price) - 3);
            return $this->giveSpace($full_part) . "." . $remainder;
        } else {
            return $this->giveSpace($price ?? 0);
        }
    }

    private function giveSpace($price)
    {
        $reversed = strrev(intval($price));
        $chunked = chunk_split($reversed, 3, " ");
        return strrev($chunked);
    }
}
