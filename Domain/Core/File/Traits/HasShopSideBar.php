<?php

namespace App\Domain\Core\File\Traits;

use App\View\Helper\Sidebar\Models\Shop\ShopSideBar;

trait HasShopSideBar
{
    protected function sideBarName(): string
    {
        return ShopSideBar::class;
    }

    protected function putInDirectory()
    {
        return "shop";
    }
    protected function headerName()
    {
        return "header_shop";
    }
}
