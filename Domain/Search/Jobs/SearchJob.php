<?php

namespace App\Domain\Search\Jobs;

use App\Domain\Core\BackgroundTask\Base\AbstractJob;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Search\Entities\Search;
use App\Domain\Search\Interfaces\SearchInterface;
use App\Domain\Search\Services\SearchService;
use Illuminate\Support\Facades\Log;

class SearchJob extends AbstractJob implements SearchInterface
{
    private $search;
    private $service;

    public function __construct($search)
    {
        $this->search = $search;
        $this->service = new SearchService();
    }

    public function handle()
    {
        Search::exactSearch($this->search)->incrementClick();
        if (Product::filterBy($this->search)->exists()) {
            $object = $this->search;
            $object['type'] = self::PRODUCT;
            try {
                $this->service->create($object);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }
        }

    }
}
