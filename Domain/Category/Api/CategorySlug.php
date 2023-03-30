<?php

namespace App\Domain\Category\Api;

class CategorySlug extends CategoryInMain
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
