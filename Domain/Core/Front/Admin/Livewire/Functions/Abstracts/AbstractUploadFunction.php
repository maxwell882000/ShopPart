<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts;

use App\Domain\Core\Main\Services\BaseService;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

abstract class AbstractUploadFunction extends AbstractFunction implements ToModel
{
    const FUNCTION_NAME = "updatedFileCustom";
    private BaseService $service;
    public $parentCounter = 0;
    public $childCounter = 0;
    public $deploy = [];
    private $livewire;


    public function __construct()
    {
        $this->service = $this->getService();
    }

    abstract function getService(): BaseService;

    static function updatedFileCustom($livewire)
    {
        if ($livewire->fileCustom and $livewire->fileCustom[0]) {
            $object = new static();
            $object->livewire = $livewire;
            Excel::import($object, $livewire->fileCustom[0]);
            $object->saveAll();
            return redirect(request()->header('Referer'));
        }
    }

    public function saveAll()
    {
        Log::info($this->deploy);
        $this->service->createOrUpdateMany($this->deploy, ['product_id' => $this->livewire->entity->id]);
    }
}
