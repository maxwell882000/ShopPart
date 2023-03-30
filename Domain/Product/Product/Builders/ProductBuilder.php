<?php

namespace App\Domain\Product\Product\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Builders\Traits\HasFilterApi;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use Illuminate\Support\Facades\DB;

class ProductBuilder extends BuilderEntity
{
    use HasFilterApi;

    public function filterByNot($filter): ProductBuilder
    {
        if (isset($filter['discount_id'])) { // integer value come here
            $this->whereNotIn("products.id", function ($query) use ($filter) {
                return $query->from("products") // create subquery, must return single column
                ->join('discount_product',
                    "discount_product.product_id",
                    '=', 'products.id')
                    ->where("discount_product.discount_id", "=", $filter['discount_id'])
                    ->select('products.id');
            });
        }
        if (isset($filter['lenta_id'])) {
            $this->whereNotIn('products.id', function ($query) use ($filter) {
                return $query->from('products')
                    ->join("lenta_product",
                        'lenta_product.product_id',
                        '=',
                        'products.id'
                    )->where("lenta_product.lenta_id", "=", $filter['lenta_id'])
                    ->select("products.id");
            });
        }
        return $this;
    }

    public function whereRate($rate)
    {
        return $this->joinSub(DB::table("mark_product", 'product_high')
            ->groupBy("product_high.product_id")
            ->having(DB::raw("AVG(product_high.mark)"), ">=", $rate)
            ->select("product_high.product_id"),
            "first", "first.product_id", "=", "products.id");
    }

    public function numberExists()
    {
        return $this->where("number", '!=', 0);
    }

    public function discountExists(): ProductBuilder
    {
        return $this->where(function ($query) {
            $query->where("products.percentage", "!=", 0);
            $query->orWhereIn("products.id", function ($query) {
                return $query->from("discount_product")
                    ->join("discounts",
                        "discount_product.discount_id",
                        "=",
                        "discounts.id"
                    )->where("status", true)
                    ->select("discount_product.product_id");
            });
            return $query;
        });
    }

    public function highRate()
    {
        return $this->whereRate(3.5);
    }

    public function joinColor()
    {
        return $this->join("color_products",
            "color_products.product_id", "=",
            "products.id")->select('products.*');
    }

    public function byColor($color_id)
    {
        return $this->joinColor()->whereIn("color_products.color_id", $color_id);
    }

    public function filterBy($filter): ProductBuilder
    {
        $currency = "( case
                            when products.currency = 1
                                then (select currency.price
                                      from currency
                                      order by id desc
                                      limit 1)
                            else 1
                         end )";
        if (isset($filter['discount_id'])) {
            $this->byDiscount($filter['discount_id']);
        }
        if (isset($filter['discount'])) {
            $this->byDiscount($filter['discount']);
        }
        if (isset($filter['lenta_id'])) {
            $this->byLenta($filter['lenta_id']);
        }
        if (isset($filter['lenta'])) {
            $this->byLenta($filter['lenta']);
        }
        if (isset($filter['color_id'])) {
            $this->byColor($filter['color_id']);
        }
        if (isset($filter['min_price'])) {
            $this->where(DB::raw("price * " . $currency), ">=", $filter['min_price']);
        }
        if (isset($filter['max_price'])) {
            $this->where(DB::raw("price * " . $currency), "<=", $filter['max_price']);
        }
        if (isset($filter['exists'])) {
            $this->numberExists();
        }
        if (isset($filter['rate_high'])) {
            $this->highRate();
        }
        if (isset($filter['discount_exists'])) {
            $this->discountExists();
        }
        if (isset($filter['brand_id'])) {
            $this->whereBrand($filter['brand_id']);
        }
        if (isset($filter['shop_id'])) {
            $this->whereShop($filter['shop_id']);
        }
        if (isset($filter['favourite'])) {
            $this->byFavourite(auth('sanctum')->user()->id);
        }
        if (isset($filter['search'])) {
            $this->byProductSearch($filter['search']);
            unset($filter['search']);
        }
        if (isset($filter['by_price'])) {
            $this->orderBy("price");
        }
        if (isset($filter['by_price_desc'])) {
            $this->orderByDesc("price");
        }
        if (isset($filter['by_discount'])) {
            $this->orderBy("percentage");
        }
        if (isset($filter['by_discount_desc'])) {
            $this->orderByDesc("percentage");
        }
//        if (isset($filter['by_popularity_desc'])) {
//            $this->orderByDesc("by_popularity_desc");
//        }
//        if (isset($filter['by_rating'])) {
//            $this->orderBy("by_rating");
//        }
//        if (isset($filter['by_rating_desc'])) {
//            $this->orderByDesc("by_rating_desc");
//        }
        return parent::filterBy($filter);
    }

    public function whereBrand($brand_id)
    {
        return $this->whereOrWhereIn("products.brand_id", $brand_id);
    }

    public function whereShop($shop_id)
    {
        return $this->whereOrWhereIn("products.shop_id", $shop_id);
    }

    public function whereOrWhereIn($column, $search)
    {
        if (gettype($search) == "array") {
            return $this->whereIn($column, $search);
        }
        return $this->where($column, $search);
    }

    public function byDiscount($discount_id): ProductBuilder
    {
        return $this->joinDiscount()->
        where("discount_id", '=', $discount_id);
    }

    public function byLenta($lenta_id)
    {
        return $this->joinLenta()
            ->where("lenta_id", '=', $lenta_id);
    }

    public function joinHitProduct()
    {
        return $this->join("product_hits", "product_hits.product_id",
            "=", "products.id")->select("products.*");
    }

    public function joinLenta($join = 'inner'): ProductBuilder
    {
        return $this->join("lenta_product",
            'lenta_product.product_id',
            '=',
            'products.id',
            $join
        )->select("products.*");
    }

    public function joinDiscount($join = "inner"): ProductBuilder
    {
        return $this->join('discount_product',
            "discount_product.product_id",
            '=', 'products.id',
            $join)->select('products.*');
    }

    public function joinDiscountFull()
    {
        return $this->joinDiscount()->join("discounts", "discounts.id",
            "=",
            "discount_product.discount_id"
        );
    }

    protected function getSearch(): string
    {
        return "title";
    }

    public function currencyUSD()
    {
        return $this->where('currency', ProductInterface::CURRENCY_USD_DB);
    }

    public function currencyUZS()
    {
        return $this->where('currency', ProductInterface::CURRENCY_UZS_DB);
    }

    public function joinHit()
    {
        return $this->join("product_hits", "product_hits.product_id",
            "=",
            "products.id")->select("products.*");
    }


    public function joinProduct()
    {
        return $this;
    }
}
