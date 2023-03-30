<?php

namespace App\Http\Controllers\Api\Traits;

use App\Domain\Category\Api\CategoryAppBar;
use App\Domain\Category\Api\CategoryItself;

trait CommonComponents
{
    protected function getHeader(): array
    {
        return [
            "header" => [
                "drop_bar" => CategoryAppBar::onlyParent()->active()->get(),
                "nav_bar" => CategoryItself::onlyParent()->active()->orderByOrder()->take(7)->get()
            ],
        ];
    }

    protected function connectWithCommon($array): array
    {
        return array_merge($array, $this->getHeader());
    }
}
