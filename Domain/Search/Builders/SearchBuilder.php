<?php

namespace App\Domain\Search\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\Search\Interfaces\SearchInterface;
use Illuminate\Support\Facades\DB;

class SearchBuilder extends BuilderEntity implements SearchInterface
{
    public function product()
    {
        return $this->where("type", "=", self::PRODUCT);
    }

    public function exactSearch($search): SearchBuilder
    {
        return $this->where($search);
    }

    public function incrementClick()
    {
        return $this->update(['clicked' => DB::raw("clicked + 1")]);
    }

    public function prioritize()
    {
        return $this->orderByDesc("clicked")->take(10)->get();
    }
}
