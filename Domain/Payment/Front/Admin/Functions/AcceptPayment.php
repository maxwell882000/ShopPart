<?php

namespace App\Domain\Payment\Front\Admin\Functions;

use App\Domain\Core\Api\CardService\Model\WithdrawMoney;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Delivery\Api\Services\OrderService;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
use Illuminate\Support\Facades\DB;

class AcceptPayment extends AbstractFunction
{
    const FUNCTION_NAME = "acceptPayment";

    static public function acceptPayment(BaseEmptyLivewire $livewire)
    {
        $entity = $livewire->entity;
        try {
            DB::beginTransaction();
            $entity->saveAccept();
            if ($entity->purchase->isCard()) {
                $money = new WithdrawMoney($entity);
                $money->saveWithdraw();
            }
            if ($entity->purchase->isDelivery()) {
                $order = new OrderService();
                $order->createOrder($entity->purchase);
            }
            DB::commit();
            session()->flash("success", __("Заказ успешно принят"));
        } catch (\Throwable $exception) {
            DB::rollBack();
            $livewire->addError("error", $exception->getMessage());
        }

    }
}
