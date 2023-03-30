<?php

namespace App\Domain\Installment\Front\Admin\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Delivery\Api\Services\OrderService;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Order\Entities\UserPurchase;
use App\Http\Livewire\Admin\Base\Abstracts\BaseEmptyLivewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AcceptInstallment extends AbstractFunction
{
    const FUNCTION_NAME = "acceptInstallment";

    static public function acceptInstallment(BaseEmptyLivewire $livewire)
    {
        try {
            DB::beginTransaction();
            $entity = $livewire->entity;
            $purchase = $entity->purchase;
            $entity->saveAccept();
            if ($purchase->isDelivery()) {
                $order = new OrderService();
                $order->createOrder($purchase);
            }
            session()->flash("success", __("Рассрочка успешно создана"));
            DB::commit();
            $livewire->dispatchBrowserEvent("redirect-show");
        } catch (\Throwable $exception) {
            DB::rollBack();
            $livewire->addError("error", $exception->getMessage());
        }

    }
}
