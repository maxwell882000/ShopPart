<?php

namespace App\Domain\Core\Main\Builders\Traits;

trait HasProductSearch
{
    public function byProductSearch($search)
    {
        if ($search)
            return $this->joinProduct()->where('title', "ilike", "%" . $search . "%");
//        return $this->joinProduct()->whereRaw("lower(products.title) like ?", ['%"' . app()->getLocale() . '":"' . strtolower($search) . '%']);
    }
}
