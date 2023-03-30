<?php

namespace App\Domain\Order\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Core\Main\Traits\FilterArray;

class PurchaseBuilder extends BuilderEntity
{

    protected function getSearch(): string
    {
        return "id";
    }

    public function filterBy($filter)
    {
        parent::filterBy($filter);
        if (isset($filter['user_purchase_id'])) {
            $this->where('user_purchase_id', $filter['user_purchase_id']);
        }
        if (isset($filter['by_created_at'])) {

        }
        return $this;
    }

    public function byUserPurchaseWithShopId($id)
    {
        return $this->joinUserPurchase()
            ->joinProducts()
            ->where("user_purchases.id", "=", $id)
            ->select("purchases.*", 'products.shop_id');
    }

    public function joinUserPurchase(): PurchaseBuilder
    {
        return $this->join("user_purchases",
            "user_purchases.id",
            "=",
            "purchases.user_purchase_id");
    }

    public function joinProducts(): PurchaseBuilder
    {
        return $this->join("products", 'products.id', '=', 'purchases.product_id');
    }
}
