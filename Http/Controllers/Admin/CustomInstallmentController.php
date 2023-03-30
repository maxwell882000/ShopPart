<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Installment\CustomInstallment\Entities\CustomInstallment;
use App\Domain\Installment\CustomInstallment\Front\Admin\Path\CustomInstallmentRouteHandler;
use App\Domain\Installment\CustomInstallment\Payable\CustomInstallmentPayable;
use App\Domain\Installment\CustomInstallment\Services\CustomInstallmentService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class CustomInstallmentController extends BaseController
{
    public function getEntityClass(): string
    {
        return CustomInstallment::class;
    }

    public function getService(): BaseService
    {
        return CustomInstallmentService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(CustomInstallmentRouteHandler::new(), "Ручную рассрочку");
    }

    public function show(Request $request, CustomInstallmentPayable $custom_installment)
    {
        return $this->getShow($request, $custom_installment, [$custom_installment]);
    }

    public function update(Request $request, CustomInstallmentPayable $custom_installment): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $custom_installment);
    }

    protected function getStore($object): \Illuminate\Http\RedirectResponse
    {
        try {
            $object = $this->service->create($object);
            return redirect()->route(
                CustomInstallmentRouteHandler::new()->getRoute(RoutesInterface::SHOW_ROUTE),
                [
                    $object->id
                ]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy(CustomInstallmentPayable $custom_installment): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($custom_installment);
    }
}
