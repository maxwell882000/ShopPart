<?php

namespace App\Domain\Search\Api;

use App\Domain\Search\Entities\Search;

class SearchApi extends Search
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "search" => $this->search,
            "type" => $this->type
        ];
    }
}
