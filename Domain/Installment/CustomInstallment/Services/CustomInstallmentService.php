<?php

namespace App\Domain\Installment\CustomInstallment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\Installment\CustomInstallment\Payable\CustomInstallmentPayable;
use App\Domain\Installment\Entities\CommentInstallment;
use App\Domain\User\Services\PlasticCardService;

// write how plastic card will be stored
class CustomInstallmentService extends BaseService
{
    use FileUploadService;

    private OnlyPlasticCardService $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new OnlyPlasticCardService();
    }

    public function getEntity(): Entity
    {
        return CustomInstallmentPayable::new();
    }

    public function create(array $object_data)
    {
        $this->serializeTempFile($object_data);
        return $this->transaction(function () use ($object_data) {
            $object = parent::create($object_data);
            $pay = new CustomInstallmentPayService($object_data, $object);
            $pay->pay();
            $object->saveAccept();
            return $object;
        });
    }
}
