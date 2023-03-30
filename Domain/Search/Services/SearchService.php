<?php

namespace App\Domain\Search\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Search\Entities\Search;
use Illuminate\Support\Facades\Log;

class SearchService extends BaseService
{

    public function getEntity(): Entity
    {
        return Search::new();
    }

    public function create(array $object_data)
    {
        return $this->transaction(function () use ($object_data) {
            $object_data['clicked'] = 1;
            $object = parent::create($object_data);
            Log::info($object);
            if ($user = auth("sanctum")->user()) {
                $user->search()->attach($object);
            }
        });
    }
}
