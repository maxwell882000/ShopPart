<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Common\Discounts\Front\Admin\Path\DiscountRouteHandler;
use App\Domain\Common\Discounts\Services\DiscountService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class DiscountsController extends BaseController
{

    public function getEntityClass(): string
    {
        return Discount::class;
    }

    public function getService(): BaseService
    {
       return DiscountService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(DiscountRouteHandler::new(), "Скидку");
    }

    public function edit(Request $request, Discount $discount)
    {
        return $this->getEdit($request, $discount, [$discount]);
    }

    public function update(Request $request, Discount $discount): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $discount);
    }

    public function destroy(Discount $discount): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($discount);
    }
}
