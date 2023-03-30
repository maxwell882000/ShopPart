<?php

namespace App\Domain\Installment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\Installment\Interfaces\PurchaseRelationInterface;
use App\Domain\Installment\Payable\TakenCreditPayable;
use App\Domain\Order\Services\UserPurchaseService;
use App\Domain\Telegrams\Job\TelegramJob;
use App\Domain\User\Entities\User;
use App\Domain\User\Services\SuretyService;
use App\Domain\User\Services\UserCreditDataService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TakenCreditService extends BaseService implements PurchaseRelationInterface
{
    use FileUploadService;

    private SuretyService $surety;
    protected UserPurchaseService $purchaseService;
    protected UserCreditDataService $creditDataService; // it for other plan , for replace of user_credit_id

    public function __construct()
    {
        $this->surety = new SuretyService();
        $this->purchaseService = new UserPurchaseService();
        $this->creditDataService = new UserCreditDataService();
        parent::__construct();
    }

    public function getEntity(): Entity
    {
        return new TakenCreditPayable();
    }



    // Do we need really surety to be created for this call
    // add check box for creation surety
    // if it was checked create and throw error when needed
    // if it is not added so skipp serialization part
    // dispatch event
    // x-data show in alpine
    // a have container to put condition
    // visible widget

    protected function userData(&$object_data)
    {
        $user_data = User::findByPlastic($object_data['plastic_id'])
            ->selectUserData()->first();
        $object_data['user_credit_data_id'] = $user_data->id;
        $object_data['user_id'] = $user_data->user_id;

        // it can be replaced. The idea is we will not just set foreign key,
        // instead we will replace fully user_credit_data_id , so it will not depend from user
        // but it will rely on taken_credit_id
//        unset($object_data['user_id']);
//        $object_data['user_credit_data_id'] = $this->creditDataService->join($object_data)->id;
    }

    public function create(array $object_data)
    {
        $this->serializeTempFile($object_data, isset($object_data['surety_is']));
        try {
            DB::beginTransaction();
            $this->userData($object_data);
            $purchases = $this->purchaseService->create($object_data);
            $object = parent::createWith($object_data, [
                'purchase_id' => $purchases->id]);
            $object_data['taken_credit_id'] = $object->id;
            Log::info($object_data);
            $payService = new InstallmentPayService($object_data, $object);
            $payService->pay();
            TelegramJob::dispatch($purchases);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }

    public function update($object, array $object_data)
    {
        return $this->transaction(function () use ($object, $object_data) {
            $surety_data = $this->popCondition($object_data, self::SURETY_SERVICE);
            if (!$object[self::SURETY_SERVICE]) {
                $object_data['surety_id'] = $this->surety->create($surety_data)->id;
            } else if ($object[self::SURETY_SERVICE]) {
                $this->surety->update($object[self::SURETY_SERVICE], $surety_data);
            }
            return parent::update($object, $object_data);
        });
    }
}
