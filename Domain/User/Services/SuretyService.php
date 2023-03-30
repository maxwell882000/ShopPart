<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Interfaces\SuretyRelationInterface;
use Illuminate\Support\Facades\DB;

class SuretyService extends BaseService implements SuretyRelationInterface
{
    use FileUploadService;

    public CrucialDataService $crucialDataService;

    public function __construct()
    {
        parent::__construct();
        $this->crucialDataService = new CrucialDataService();
    }

    public function getEntity(): Entity
    {
        return new Surety();
    }

    /**
     * @throws \Throwable
     */
    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $this->serializeTempFile($object_data);
            $this->changeKey($object_data, 'user_id');
            $crucial_data = $this->popCondition($object_data, self::CRUCIAL_DATA_SERVICE);
            $crucial = $this->crucialDataService->create($crucial_data);
            $object_data['crucial_data_id'] = $crucial->id;
            $object = parent::create($object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }

    }

    public function update($object, array $object_data)
    {
        try {
            DB::beginTransaction();
            $crucial_data = $this->popCondition($object_data, self::CRUCIAL_DATA_SERVICE);
            if (!empty($crucial_data)) {
                $this->crucialDataService
                    ->update($object[self::CRUCIAL_DATA_SERVICE], $crucial_data);
            }
            $object = parent::update($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }
}
