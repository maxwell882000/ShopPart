<?php

namespace App\Http\Controllers\Api\Main;

use App\Domain\Category\Api\CategoryInHomeApi;
use App\Domain\Category\Api\CategoryInMain;
use App\Domain\Common\Banners\Entities\BannerReadOnly;
use App\Domain\Common\Discounts\Entities\DiscountReadOnly;
use App\Domain\Lenta\Api\LentaApi;
use App\Domain\Product\Api\ProductCard;
use App\Domain\Product\Product\Entities\ProductOfDay;
use App\Domain\Shop\Api\ShopCard;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Api\Traits\CommonComponents;
use Illuminate\Http\Request;

// when timer goes down , refresh page
class MainController extends ApiController
{
    use CommonComponents;

    private function getHours()
    {
        return sprintf("%s:", 24 - now()->hour);
    }

    public function main(Request $request)
    {
        return $this->result([
            "banners" => BannerReadOnly::all(),
            "product_of_day" => [
                "hours" => 24 - now()->hour,
                "minutes" => 60 - now()->minute,
                "seconds" => 60 - now()->second,
                "items" => ProductOfDay::with("product")->get(),
            ],
            "discount" => [
                self::FILTER => "discount",
                "items" => DiscountReadOnly::active()->get()
            ],
            "popular_category" => $request->get("isMobile") ? CategoryInMain::query()->active()->onlyChild()->orderByOrder()->take(6)->get() : [],
            "hit_products" => ProductCard::query()->joinHitProduct()->take(10)->get(),
            "shop_list" => ShopCard::take(self::BIG_PAGINATE)->get()
        ]);
    }


    public function header(): \Illuminate\Http\JsonResponse
    {
        return $this->result($this->getHeader());
    }

    public function category()
    {
        return $this->result(CategoryInMain::active()->orderByOrder()->take(6)->get());
    }

    public function hitProduct()
    {
        return $this->result(ProductCard::joinHit()->get());
    }

    public function products()
    {
        return $this->result(ProductCard::orderBy("id", "DESC")->get());
    }

    public function lenta()
    {
        return $this->result(LentaApi::all());
    }

    public function categoryInHome()
    {
        return $this->result(CategoryInHomeApi::query()->orderBy("sort")->orderBy("category_id")->get());
    }


}
