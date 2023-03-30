<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\Path\SuretyRouteHandler;
use App\Domain\User\Services\SuretyService;
use App\Http\Controllers\Base\Abstracts\BaseOpenController;
use Illuminate\Http\Request;

class SuretyController extends BaseOpenController
{

    public function getEntityClass(): string
    {
        return Surety::class;
    }

    public function getService(): BaseService
    {
        return SuretyService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(SuretyRouteHandler::new(), 'Поручитель');
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

    public function edit(Request $request, Surety $surety)
    {
        return $this->getEdit($request, $surety, [$surety]);
    }

    public function update(Request $request, Surety $surety)
    {
        return $this->getUpdateValidation($request, $surety);
    }
}
