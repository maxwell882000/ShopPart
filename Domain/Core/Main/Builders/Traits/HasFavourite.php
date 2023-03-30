<?php

namespace App\Domain\Core\Main\Builders\Traits;

trait HasFavourite
{
    public function byFavourite($user_id)
    {
        return $this->joinProduct()->joinFavourite()->where("favourites.user_id", "=", $user_id)->distinct();
    }

    public function joinFavourite()
    {
        return $this->join("favourites", "favourites.product_id",
            "=",
            "products.id");
    }

}
