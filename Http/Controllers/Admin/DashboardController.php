<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Core\Main\Services\EmptyService;
use App\Domain\Dashboard\Models\Dashboard;
use App\Domain\Dashboard\Path\DashboardRouteHandler;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{

    public function getEntityClass(): string
    {
        return  Dashboard::class;
    }

    public function getService(): BaseService
    {
        return EmptyService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(DashboardRouteHandler::new(), "Главная");
    }

}
