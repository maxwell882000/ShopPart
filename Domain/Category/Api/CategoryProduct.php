<?php

namespace App\Domain\Category\Api;

use App\Domain\Category\Entities\Category;

class CategoryProduct extends Category
{
    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, "parent_id");
    }

    public function toArray()
    {
        $result = [];
        if ($this->parent)
            foreach ($this->parent->toArray() as $item) {
                array_push($result, $item);
            }
        $object = [
            'id' => $this->id,
            'name' => $this->name_current,
            'slug' => $this->slug,
            'is_last' => $this->height == 0,
            "depth" => $this->depth
        ];
        array_push($result, $object);
        return $result;
    }
}
