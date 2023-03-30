<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Core\Main\Services\EmptyService;
use App\Domain\Settings\Front\Path\SettingRouteHandler;
use App\Domain\Settings\Main\SettingsIndex;
use App\Http\Controllers\Base\Abstracts\BaseController;

class SettingController extends BaseController
{

    public function getEntityClass(): string
    {
        return SettingsIndex::class;
    }

    public function getService(): BaseService
    {
        return EmptyService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(SettingRouteHandler::new(), "Настройки");
    }

}
