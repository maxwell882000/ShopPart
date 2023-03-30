<?php

namespace App\Domain\Payment\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Delivery\Api\Traits\HasCancelDeliveryTrait;
use App\Domain\Installment\Interfaces\PurchaseStatus;

class DenyPayment extends AbstractFunction
{
    use HasCancelDeliveryTrait;

    const FUNCTION_NAME = 'denyPayment';
    protected $entity;
    protected $reason;

    public function create($entity, $reason)
    {
        $this->entity = $entity;
        $this->reason = $reason;
    }

    private function deny()
    {
        $this->entity->status = PurchaseStatus::DECLINED;
        $this->entity->save();
    }

    public function denyUser()
    {
        $this->setErrorStatus(true);
        $this->deny();
    }

    public function denyAdmin()
    {
        $this->setErrorStatus(false);
        $this->deny();
    }

    private function setErrorStatus($is_user)
    {
        $this->entity->reason()->create(['reason' => $this->reason, 'is_user' => $is_user]);
    }

    public function denyAll()
    {
        $this->deny();
        $this->cancelDelivery();
    }

    static public function denyPayment($livewire)
    {
        $object = new static();
        $object->create($livewire->entity, $livewire->reason);
        $object->denyAdmin();
    }
}
