<?php

namespace App\Domain\Order\Api;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Order\Entities\Purchase;
use App\Domain\Product\ProductKey\Entities\ProductValue;

class PurchaseApi extends Purchase
{
    private function generateTitle()
    {
        $title = $this->product->title_current;
        if (isset($this->order['colors'])) {
            $color = Color::find($this->order['colors']['id']);
            $title = $title . "," . $color->getColorCurrentAttribute();
        }
        if (isset($this->order['additional'])) {
            foreach ($this->order['additional'] as $key => $item) {
                $text = ProductValue::find($item['value']['id']);
                $title = $title . "," . $text->getTextCurrentAttribute();
            }
        }
        return $title;
    }



    public function toArray()
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'image' => $this->product->productImageHeader->image->fullPath(),
            'title' => $this->generateTitle()
        ];
    }
}
