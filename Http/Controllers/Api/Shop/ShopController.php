<?php

namespace App\Http\Controllers\Api\Shop;

use App\Domain\Category\Api\CategoryItself;
use App\Domain\Common\Api\BrandInFilter;
use App\Domain\Common\Api\ColorInFilter;
use App\Domain\Shop\Api\ShopCard;
use App\Domain\Shop\Api\ShopView;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Api\Interfaces\FilterInterfaceApi;

class ShopController extends ApiController implements FilterInterfaceApi
{
    public function getShop(ShopView $shop)
    {
        return $this->result([
            'shop' => $shop,
            'filter' => [
                self::F_CATEGORY => CategoryItself::byShop($shop->id)->get(),
                self::F_COLOR => ColorInFilter::byShop($shop->id)->get(),
                self::F_BRAND => BrandInFilter::byShop($shop->id)->get(),
            ]
        ]);
    }

    public function getAllShop(): \Illuminate\Http\JsonResponse
    {
        return $this->result([
            'shop_all' => ShopCard::all()
        ]);
    }
}
