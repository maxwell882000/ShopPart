<?php

namespace App\Domain\Search\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Search\Builders\SearchBuilder;

class Search extends Entity
{
    protected $table = "searches";
    protected $guarded = null;
    protected $fillable = [
        "search",
        "type"
    ];

    protected $attributes = [
        'clicked' => 1
    ];

    public function newEloquentBuilder($query): SearchBuilder
    {
        return new SearchBuilder($query);
    }
}
