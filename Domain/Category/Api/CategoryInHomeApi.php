<?php

namespace App\Domain\Category\Api;

use App\Domain\Category\Entities\CategoryInHome;

class CategoryInHomeApi extends CategoryInHome
{

    public function toArray()
    {
        return [
            "category" => $this->category,
            "color" => $this->color,
            "back_color" => $this->back_color
        ];
    }
}
