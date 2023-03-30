<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Front\Admin\Path\TakenCreditRouteHandler;
use App\Domain\Installment\Payable\TakenCreditPayable;
use App\Domain\Installment\Services\TakenCreditService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

/*
 * PROBLEMS
 * interdependent dropdowns
 * after choosing sum has to be calculated
 * after choosing products sum has to be calculated
 *
 * */

class TakenCreditController extends BaseController
{

    public function getEntityClass(): string
    {
        return TakenCredit::class;
    }

    public function getService(): BaseService
    {
        return TakenCreditService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(TakenCreditRouteHandler::new(), "Рассрочка");
    }

    public function index(Request $request)
    {

        return $this->getIndex($request);
    }

    public function create(Request $request)
    {
        return $this->getCreate($request);
    }

    public function store(Request $request)
    {
        return $this->getStoreValidation($request);
    }

    public function edit(Request $request, TakenCreditPayable $taken_credit)
    {
        return $this->getEdit($request, $taken_credit, [$taken_credit]);
    }

    public function show(Request $request, TakenCreditPayable $taken_credit)
    {
        return $this->getShow($request, $taken_credit, [$taken_credit]);
    }

    public function update(Request $request, TakenCreditPayable $taken_credit): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $taken_credit);
    }

    public function destroy(TakenCreditPayable $taken_credit): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($taken_credit);
    }

}
