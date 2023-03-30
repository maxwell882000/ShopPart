<?php

namespace App\Http\Controllers\Api\Category;

use App\Domain\Category\Api\CategoryAppBar;
use App\Domain\Category\Api\CategoryInMain;
use App\Domain\Category\Api\CategoryParentView;
use App\Domain\Category\Api\CategorySlug;
use App\Domain\Category\Api\CategoryWithProductApi;
use App\Domain\Common\Api\BrandInFilter;
use App\Domain\Common\Api\BrandMain;
use App\Domain\Common\Api\ColorInFilter;
use App\Domain\Common\Discounts\Entities\DiscountReadOnly;
use App\Domain\Product\Api\ProductCard;
use App\Domain\Shop\Api\ShopInFilter;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Api\Interfaces\FilterInterfaceApi;

// work on this
// write correct query for poping more popular product and discount and brand
class CategoryViewController extends ApiController implements FilterInterfaceApi
{
    const CATEGORY = 2;
    const VIEW = 0;
    const SUB_CATEGORY = 1;

    public function view(CategorySlug $category)
    {
        $object = null;
        switch ($category->height) {
            case self::CATEGORY:
                $object = $this->categoryPage($category);
                break;
            case  self::SUB_CATEGORY:
                $object = $this->subCategoryPage($category);
                break;
            case self::VIEW;
                $object = $this->viewPage($category);
                break;
        }
        if ($object) {
            $object['depth'] = $category->depth;
            return $this->result($object);
        }

        return $this->errors(__("The height is bigger than expected:"
            . sprintf("Category id : %s", $category->id)), 500);
    }

    // this is filters for wrapper
    private function viewPage($category)
    {
        return [
            self::F_BRAND => BrandInFilter::byCategory($category->id)->get(),
            self::F_COLOR => ColorInFilter::byCategory($category->id)->get(),
            self::F_SHOP => ShopInFilter::byCategory($category->id)->get()
        ];
    }

    private function categoryPage($category): array
    {
        return [
            "side_category" => CategoryAppBar::childs($category->id),
            "discounts" => [
                self::FILTER => "discount",
                "items" => DiscountReadOnly::active()->get()
            ],
            "product_in_categories" => CategoryParentView::childs($category->id)->get()
        ];
    }

    private function subCategoryPage($category): array
    {
        return [
            "side_category" => CategoryAppBar::childs($category->parent_id),
            "sub_categories" => CategoryWithProductApi::childs($category->id)->get(),
            "pop_products" => ProductCard::popInCategory($category->id)
                ->paginate(self::BIG_PAGINATE), // not used for know
            "discount_products" => ProductCard::disInCategory($category->id)
                ->paginate(self::BIG_PAGINATE), // not used for know
        ];
    }


    public function productInCategory(CategoryParentView $category)
    {

        return $this->result($category->products()->take(self::BIG_PAGINATE)->get());
    }

    public function brand(CategoryInMain $category)
    {
        return $this->result([
            "brands" => BrandMain::popInCategory($category->id)
        ]);
    }
}
