<?php

namespace App\Domain\Core\Front\Admin\Routes\Routing;

interface ShopRoutesInterface
{
    const SHOP = "shop.";
    const PRODUCT = self::SHOP . 'product';
    const DASHBOARD = self::SHOP . "dashboard";
    const OWN_VIEW = self::SHOP . "own_view";
}
