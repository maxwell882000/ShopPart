<?php

namespace App\Domain\Product\Product\Builders;

class ProductCardBuilder extends ProductBuilder
{
    public function joinInfo()
    {
        return $this->join("product_infos", "product_infos.id",
            "=",
            "products.id");
    }

    public function onlyPopular()
    {
        return $this->joinInfo()->orderBy("product_infos.views_num", "DESC");
    }

    public function byCategory($category_id)
    {
        return $this->where("category_id", "=", $category_id);
    }

    public function notIdIn($ids)
    {
        return $this->whereNotIn("id", $ids);
    }

    public function byCategoryIn($category_id)
    {
        return $this->whereIn("category_id", $category_id);
    }

    public function joinCategory()
    {
        return $this->join("categories",
            "categories.id",
            "=",
            "products.category_id")->select("products.*");
    }

    public function byCategorySlug($category_slug): ProductCardBuilder
    {
        return $this->joinCategory()->where("categories.slug", "=", $category_slug);
    }

    public function byCategorySlugIn($categories_slug)
    {
        return $this->joinCategory()->whereIn("categories.slug", $categories_slug);
    }

    public function filterBy($filter): ProductBuilder
    {
        if (isset($filter['hits'])) {
            $this->joinHitProduct();
        }
        if (isset($filter['category_id'])) {
            $this->byCategory($filter['category_id']);
        }
        if (isset($filter['category_slug'])) {
            $this->byCategorySlug($filter['category_slug']);
        }
        if (isset($filter["category_slug_in"])) {
            $this->byCategorySlugIn($filter['category_slug_in']);
        }
        return parent::filterBy($filter);
    }

    public function disInCategory($category_id)
    {
        return $this->byCategory($category_id)
            ->joinDiscountFull()
            ->orderBy("discounts.percent", "DESC");
    }

    public function popInCategory($category_id)
    {
        return $this->byCategory($category_id)->onlyPopular();
    }
}
