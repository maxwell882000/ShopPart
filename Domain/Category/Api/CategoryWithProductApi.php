<?php

namespace App\Domain\Category\Api;


use App\Http\Controllers\Api\Interfaces\ApiControllerInterface;

class CategoryWithProductApi extends CategoryParentView
{
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->getNameCurrentAttribute(),
            "slug" => $this->slug,
            'product' => $this->products()->take(ApiControllerInterface::BIG_PAGINATE)->get()
        ];
    }
}
