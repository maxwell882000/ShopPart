<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Domain\Core\Api\CardService\Model\WithdrawMoney;
use App\Domain\Installment\Front\Admin\Functions\DenyInstallment;
use App\Domain\Installment\Payable\MonthPaidClientPayable;
use App\Domain\Installment\Payable\TakenCreditPayable;
use App\Domain\Order\Api\UserPurchasesApi;
use App\Domain\Payment\Entities\Payment;
use App\Domain\Payment\Front\Admin\Functions\DenyPayment;
use App\Domain\User\Entities\PlasticCard;
use App\Http\Controllers\Api\Base\ApiController;
use Illuminate\Support\Facades\Log;

class PurchaseController extends ApiController
{
    public function getPurchases(): \Illuminate\Http\JsonResponse
    {
        $filter = array_merge($this->request->all(), [
            'user_id' => auth('sanctum')->user()->id,
            "by_created_at" => "by_created_at"
        ]);
        return $this->result([
            'purchases' => UserPurchasesApi::filterBy($filter)->get()
        ]);
    }

    // we give permission only if purchase was not accepted
    public function cancelInstallment(TakenCreditPayable $credit): \Illuminate\Http\JsonResponse
    {
        if ($credit->isAccepted()) {
            return $this->errors(__("Вам необходимо связаться с администрацией, чтоб отклонить"));
        }
        $this->validateRequest([
            'reason' => 'required',
        ]);
        return $this->saveResponse(function () use ($credit) {
            $object = new DenyInstallment();
            $object->create($credit, $this->request->reason, false);
            $object->denyUser();
            return $this->result([]);
        });
    }

    public function payForMonth(MonthPaidClientPayable $monthPaid)
    {
        return $this->saveResponse(function () use ($monthPaid) {
            $token = null;
            if ($plastic = $this->request->plastic_id) {
                $token = PlasticCard::find($plastic)->card_token;
            }
            $service = new WithdrawMoney($monthPaid);
            $service->withdraw($token);
            $taken_credit = $monthPaid->takenCredit;
            $monthPaid->refresh();
            return $this->result([
                'paid' => $monthPaid->paid,
                'next_paid_month' => $taken_credit->nextPay()->id,
                'status' => $taken_credit->status,
            ]);
        });
    }

    public function cancelPayment(Payment $payment): \Illuminate\Http\JsonResponse
    {

        return $this->saveResponse(function () use ($payment) {
            $this->validateRequest([
                'reason' => "required"
            ]);
            $object = new DenyPayment();
            $object->create($payment, $this->request->reason);
            $object->denyUser();
            return $this->result([]);
        });
    }

    public function repeatPayment()
    {

    }
}
