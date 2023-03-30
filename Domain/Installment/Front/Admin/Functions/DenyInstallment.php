<?php

namespace App\Domain\Installment\Front\Admin\Functions;

use App\Domain\Core\Api\CardService\Error\CardServiceError;
use App\Domain\Core\Api\CardService\Model\WithdrawMoney;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Currency\Entities\HoldMoney;
use App\Domain\Delivery\Api\Traits\HasCancelDeliveryTrait;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DenyInstallment extends AbstractFunction
{
    use HasCancelDeliveryTrait;

    const FUNCTION_NAME = "denyInstallment";
    protected $entity;
    protected $reason;
    protected $hold;

    public function create($entity, $reason, $hold = true)
    {
        $this->entity = $entity;
        $this->reason = $reason;
        $this->hold = $hold; // return whole amount of money
    }

    private function denyStatus()
    {
        $this->entity->status = PurchaseStatus::DECLINED;
        $this->entity->save();
    }

    /// DENYY
    ///  what if initial pay will be smaller then amount of hold money, what to do in this case?
    private function deny()
    {
        $this->denyStatus();
        if ($this->hold) {
            $money = new WithdrawMoney($this->entity);
            $amount_return = HoldMoney::first()->hold;;
            try {
                $money->reverse($amount_return);
            } catch (CardServiceError $exception) {
                if ($exception->getCode() == CardServiceError::NOT_INITIAL_PAY) {
                    $money->withdraw(null, $amount_return);
                    $this->denyStatus(); // just in case
                }

                throw $exception;
            }
        }
    }

    public function denyUser()
    {
        $this->setErrorReason(true);
        $this->deny();
    }

    public function denyAdmin()
    {
        $this->setErrorReason(false);
        $this->deny();
    }

    private function setErrorReason($is_user)
    {
        $this->entity->reason()->create([
            'reason' => $this->reason,
            'is_user' => $is_user
        ]);
    }

    public function saveDeny()
    {
        try {
            DB::beginTransaction();
            $this->deny();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        try {
            $this->cancelDelivery();
        } catch (\Throwable $exception) {

        }
    }

    public static function denyInstallment(BaseEmptyLivewire $livewire, $hold)
    {
        $object = new static();
        try {
            DB::beginTransaction();
            $object->create($livewire->entity, $livewire->reason, $hold);
            $object->denyAdmin();
            $livewire->addError("error", __("Рассрочка успешно отвергнута"));
            DB::commit();
            $livewire->dispatchBrowserEvent("redirect-show");
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::error($exception->getTraceAsString());
            $livewire->addError("error", $exception->getMessage());
            return;
        }
    }
}
