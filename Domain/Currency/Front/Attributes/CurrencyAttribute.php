<?php

namespace App\Domain\Currency\Front\Attributes;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class CurrencyAttribute implements HtmlInterface
{

    public function generateHtml(): string
    {
        return "<livewire:components.currency-field.currency/>";
    }
}
