<?php

namespace App\Http\Controllers\Api\Product;

use App\Domain\Product\Api\ProductCard;
use App\Domain\Product\Api\ProductView;
use App\Domain\Search\Jobs\SearchJob;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends ApiController
{
    public function view(ProductView $product)
    {
        return $this->result($product->toArray());
    }

    public function rate(ProductView $product)
    {
        return $this->result([
            "mark_5" => $this->markNumber($product, 5),
            "mark_4" => $this->markNumber($product, 4),
            "mark_3" => $this->markNumber($product, 3),
            "mark_2" => $this->markNumber($product, 2),
            "mark_1" => $this->markNumber($product, 1),
            "mark" => number_format($product->mark()->avg("mark"), 1) ?? 0,
            "mark_num" => $product->mark()->count()
        ]);
    }

    private function markNumber(ProductView $product, $mark): int
    {
        return $product->mark()->where("mark", "=", $mark)->count();
    }

    public function productFilterFull(Request $request) // all filtration happens here
    {
        if ($request->get("search")) {
            Log::info("get search");
            Log::info($request->get("search"));
            SearchJob::dispatch(['search' => $request->get('search')]);
        }
        return $this->result(ProductCard::filterBy($request->all())->paginate(self::NORMAL_PAGINATE));
    }


}
