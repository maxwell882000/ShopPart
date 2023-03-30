<?php

namespace App\Http\Controllers\Api\Search;

use App\Domain\Category\Api\CategoryItself;
use App\Domain\Common\Api\BrandInFilter;
use App\Domain\Common\Api\ColorInFilter;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Search\Api\SearchApi;
use App\Domain\Shop\Api\ShopInFilter;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Api\Interfaces\FilterInterfaceApi;
use Illuminate\Http\Request;

class SearchController extends ApiController implements FilterInterfaceApi
{
    public function searchHelpers(Request $request)
    {
        return $this->result([
            'products' => SearchApi::product()->filterBy($request->all())->prioritize() // key searches for product
        ]);
    }

    public function searchProducts(Request $request)
    {
        $search = $request->search;
        $product = Product::byProductSearch($search);
        return $this->result([
            self::F_BRAND => BrandInFilter::byProductSearch($search)->get(),
            self::F_COLOR => ColorInFilter::byProductSearch($search)->get(),
            self::F_CATEGORY => CategoryItself::byProductSearch($search)->get(),
            self::F_SHOP => ShopInFilter::byProductSearch($search)->get(),
            self::F_COUNT => $product->count(),
            self::F_DISCOUNT_EXISTS => $product->discountExists()->exists() ? 1 : -1,
            self::F_EXISTS => $product->numberExists()->exists() ? 1 : -1,
            self::F_RATE_HIGH => $product->highRate()->exists() ? 1 : -1
        ]);
    }
}
