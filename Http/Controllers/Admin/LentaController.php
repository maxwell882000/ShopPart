<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Lenta\Front\Admin\Path\LentaRouteHandler;
use App\Domain\Lenta\Services\LentaService;
use App\Domain\Payment\Entities\Payment;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class LentaController extends BaseController
{

    public function getEntityClass(): string
    {
        return Lenta::class;
    }

    public function getService(): BaseService
    {
        return LentaService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(LentaRouteHandler::new(), "Лента");
    }

    public function edit(Request $request,Lenta  $lentum)
    {
        return $this->getEdit($request, $lentum, [$lentum]);
    }

    public function update(Request $request, Lenta $lentum): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $lentum);
    }

    public function destroy(Lenta $lentum): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($lentum);
    }
}
