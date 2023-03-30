<?php

namespace App\Domain\Category\Api;

class CategoryView extends CategoryInMain
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->getNameCurrentAttribute(),
            "slug" => $this->slug,
            "depth" => $this->depth,
            'is_last' => $this->height == 0,
            "image" => $this->icon->image->fullPath(),
        ];
    }
}
