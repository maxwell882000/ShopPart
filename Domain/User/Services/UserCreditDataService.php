<?php

namespace App\Domain\User\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\User\Entities\CrucialData;
use App\Domain\User\Entities\UserCreditData;
use App\Domain\User\Interfaces\UserRelationInterface;

class UserCreditDataService extends BaseService implements UserRelationInterface
{
    use FileUploadService;

    private CrucialDataService $crucialService;

    public function __construct()
    {
        parent::__construct();
        $this->crucialService = new CrucialDataService();
    }

    public function getEntity(): Entity
    {
        return new UserCreditData();
    }

    public function create(array $object_data)
    {
        $this->serializeTempFile($object_data);
        return $this->transaction(function () use ($object_data) {
            $crucial_data = $this->popCondition($object_data, self::CRUCIAL_DATA_SERVICE);
            $crucial = $this->crucialService->create($crucial_data);
            $object_data['crucial_data_id'] = $crucial->id;
            return parent::create($object_data);
        });
    }
    // not required , but could be used
    // if it will be used, remember to add nullable to user_credit_datas for user
    public function join(array $object_data)
    {
        $crucial = $this->crucialService->create(CrucialData::find($object_data['crucial_data_id'])->toArray());
        $object_data['crucial_data_id'] = $crucial->id;
        return parent::create($object_data);
    }
}
