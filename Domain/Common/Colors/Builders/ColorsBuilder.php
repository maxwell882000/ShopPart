<?php

namespace App\Domain\Common\Colors\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Builders\Traits\HasFilterApi;
use Illuminate\Support\Facades\Schema;

class ColorsBuilder extends BuilderEntity
{
    use  HasFilterApi;

    protected function getSearch(): string
    {
        return "color";
    }

    public function joinColorProducts()
    {
        return $this->join(
            "color_products",
            "color_products.color_id",
            "=",
            "colors.id")
            ->select("colors.*");
    }

    public function joinProduct()
    {

        return $this->joinColorProducts()->join(
            "products",
            "products.id",
            "=",
            "color_products.product_id");
    }

    public function byCategory($category_id)
    {
        return $this->joinProduct()
            ->where("products.category_id", "=", $category_id)
            ->distinct();
    }
}
