<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Main\CategoryEdit;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Admin\Path\MainCreditRouteHandler;
use App\Domain\CreditProduct\Services\MainCreditService;
use App\Domain\Product\Product\Entities\Product;
use App\Http\Controllers\Base\Abstracts\BaseController;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductEditRequest;
use Illuminate\Http\Request;

class MainCreditController extends BaseController
{

    public function getEntityClass(): string
    {
        return MainCredit::class;
    }

    public function getService(): BaseService
    {
        return MainCreditService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(MainCreditRouteHandler::new(), __("Рассрочка"));
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

    public function edit(Request $request, MainCredit $main_credit)
    {
        return $this->getEdit($request, $main_credit, [$main_credit]);
    }

    public function update(Request $request, MainCredit $main_credit): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $main_credit);
    }

    public function destroy(MainCredit $main_credit): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($main_credit);
    }
}
