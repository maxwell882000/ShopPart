<?php

namespace App\Domain\Product\Product\Front\Traits;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;

trait ProductCommonTableAttributes
{
    public function getCurrencyIndexAttribute(): string
    {
        return TextAttribute::generation($this, self::DB_TO_TEXT[$this->currency], true);
    }

    public function getNumberIndexAttribute(): string
    {
        return TextAttribute::generation($this, "number");
    }

    public function getShopIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->shop->name ?? "", true);
    }

    public function getCategoryIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->category->name_current, true);
    }

    public function getNameIndexAttribute(): string
    {
        return TextAttribute::generation($this, 'title_current');
    }

    public function getPriceIndexAttribute(): string
    {
        return TextAttribute::generation($this, "price_show");
    }
}
