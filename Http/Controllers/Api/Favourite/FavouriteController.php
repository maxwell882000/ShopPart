<?php

namespace App\Http\Controllers\Api\Favourite;

use App\Domain\Category\Api\CategoryItself;
use App\Domain\Common\Api\BrandInFilter;
use App\Domain\Common\Api\ColorInFilter;
use App\Domain\Shop\Api\ShopInFilter;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Api\Interfaces\FilterInterfaceApi;

class FavouriteController extends ApiController implements FilterInterfaceApi
{
    public function getFavourite()
    {
        $id = auth()->user()->id;
        $favourite = auth()->user()->favourite();
        return $this->result([
            self::F_BRAND => BrandInFilter::byFavourite($id)->get(),
            self::F_COLOR => ColorInFilter::byFavourite($id)->get(),
            self::F_CATEGORY => CategoryItself::byFavourite($id)->get(),
            self::F_SHOP => ShopInFilter::byFavourite($id)->get(),
            self::F_COUNT => $favourite->count(),
            self::F_DISCOUNT_EXISTS => $favourite->where(function ($query) {
                return $query->where('percentage', ">", 0)->orWhereIn("products.id", function ($query) {
                    return $query->select("product_id")
                        ->from("discount_product")
                        ->join("discounts",
                            "discounts.id",
                            "=",
                            "discount_product.discount_id")
                        ->where("discounts.status", true);
                });
            })->exists() ? 1 : -1,
            self::F_EXISTS => $favourite->where("products.number", ">", 0)->exists() ? 1 : -1,
            self::F_RATE_HIGH => -1
        ]);
    }
}
