<?php

namespace App\Domain\Shop\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Builders\Traits\HasFilterApi;

class ShopBuilder extends BuilderEntity
{
    use HasFilterApi;

    public function getSearch(): string
    {
        return "name";
    }

    public function joinProduct()
    {
        return $this->join("products", "products.shop_id",
            "=",
            "shops.id")->select("shops.*");
    }

    public function byCategory($category_id)
    {
        return $this->joinProduct()
            ->where("products.category_id", $category_id)
            ->distinct();
    }

    public function scopeCloseTo($location, $radius = 100)
    {

        /**
         * In order for this to work correctly, you need a $location object
         * with a ->latitude and ->longitude.
         */
        $latitude = $location['latitude'];
        $longitude = $location['longitude'];
        $haversine = "(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";
        return $this
            ->select(['comma', 'separated', 'list', 'of', 'your', 'columns'])
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
