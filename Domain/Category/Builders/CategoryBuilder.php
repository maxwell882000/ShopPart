<?php

namespace App\Domain\Category\Builders;

use App\Domain\Category\Entities\CategoryInHome;
use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Builders\Traits\HasFilterApi;
use Illuminate\Support\Facades\DB;

class CategoryBuilder extends BuilderEntity
{
    use HasFilterApi;

    public function onlyParent()
    {
        return $this->with("childsCategory")->where("depth", "=", 1);
    }

    public function onlyChild()
    {
        return $this->where("height", '=', 0);
    }


    public function active()
    {
        return $this->where("status", true);
    }

    public function orderByOrder()
    {
        return $this->orderBy("order");
    }

    public function childs($parent_id)
    {
        return $this->active()->where("parent_id", "=", $parent_id);
    }

    public function joinParent()
    {
        return $this->leftJoin(DB::raw("categories as first"),
            "first.id",
            "=",
            "categories.parent_id");
    }

    public function byPurchaseIn($purchases_in): CategoryBuilder
    {

        return $this->joinPurchases()->whereIn("purchases.id", $purchases_in)
            ->select("categories.*")->distinct();
    }

    private function joinProduct(): CategoryBuilder
    {
        return $this->join("products", "products.category_id",
            "=", 'categories.id')->select("categories.*");
    }

    public function joinPurchases(): CategoryBuilder
    {
        return $this->joinProduct()->join("purchases", "purchases.product_id", "=",
            "products.id");
    }

    public function joinCategoryInHome()
    {
        return $this->join("category_in_home", "category_in_home.category_id",
            "=", "categories.id")->distinct();
    }

    public function filterBy($filter): CategoryBuilder
    {
        parent::filterBy($filter);
        if (isset($filter['parent_id'])) {
            $this->where($this->getParent(), '=', $filter['parent_id'])
                ->where("id", "!=", $filter['parent_id']);
        }
        if (isset($filter['depth'])) {
            $this->where("depth", "=", $filter['depth']);
        }
        if (isset($filter['height'])) {
            $this->where("height", $filter['height']);
        }
        if (isset($filter['not_in_category_in_home'])) {
            $this->whereNotIn('id', CategoryInHome::all()->pluck("category_id"));
        }
        if (isset($filter['order_by_order'])) {
            $this->orderByOrder();
        }
        return $this;
    }

    public function filterByNot($filter): CategoryBuilder
    {

        if (isset($filter["parent_id"])) {
            $this->where(function ($builder) use ($filter) {
                $builder->where(function (BuilderEntity $builder) use ($filter) {
                    return $builder->whereNull($this->getParent())
                        ->where("id", "!=", $filter["parent_id"]);
                })->orWhere($this->getParent(), "!=", $filter["parent_id"]);
            });
        }
        if (isset($filter['order_by_order'])) {
            $this->orderBy('order');
        }
        return $this;
    }

    protected function getSearch(): string
    {
        return "name";
    }
}
