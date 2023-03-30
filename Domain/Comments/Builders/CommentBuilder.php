<?php

namespace App\Domain\Comments\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Entities\Entity;

class CommentBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "message";
    }

    public function show($product_id)
    {
        if ($product_id instanceof Entity) {
            $product_id = $product_id->id;
        }
        return $this->byProduct($product_id)->where("status", true);
    }
    public function byProduct($product_id) {
        return $this->where("product_id", $product_id);
    }
}
