<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Payment\Entities\Payment;
use App\Domain\Payment\Front\Admin\Route\PaymentRouteHandler;
use App\Domain\Payment\Payable\PaymentPayable;
use App\Domain\Payment\Services\PaymentService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{

    public function getEntityClass(): string
    {
        return Payment::class;
    }

    public function getService(): BaseService
    {
        return PaymentService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(PaymentRouteHandler::new(), "Заказ");
    }

    public function edit(Request $request, PaymentPayable $payment)
    {
        return $this->getEdit($request, $payment, [$payment]);
    }

    public function update(Request $request, PaymentPayable $payment): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $payment);
    }

    public function destroy(PaymentPayable $payment): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($payment);
    }

    public function show(Request $request, PaymentPayable $payment)
    {
        return $this->getShow($request, $payment, [$payment]);
    }
}
