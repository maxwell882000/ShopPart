<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\Policies\Entity\Policy;
use App\Domain\Policies\Front\Admin\Path\PolicyRouteHandler;
use App\Domain\Policies\Services\PolicyService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class PolicyController extends BaseController
{

    public function getEntityClass(): string
    {
        return Policy::class;
    }

    public function getService(): BaseService
    {
        return PolicyService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(PolicyRouteHandler::new(), "Политика и Конфеденциальность");
    }

    public function edit(Request $request, Policy $policy)
    {
        return $this->getEdit($request, $policy, [$policy]);
    }

    public function update(Request $request, Policy $policy): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $policy);
    }

    public function destroy(Policy $policy): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($policy);
    }
}
