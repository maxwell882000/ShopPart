<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Delivery\Entities\AvailableCities;
use App\Domain\Delivery\Front\Admin\Path\AvailableCitiesRouter;
use App\Domain\Delivery\Services\AvailableCitiesService;
use App\Http\Controllers\Base\Abstracts\BaseController;

class AvailableCityController extends BaseController
{

    public function getEntityClass(): string
    {
        return AvailableCities::class;
    }

    public function getService(): BaseService
    {
        return AvailableCitiesService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(AvailableCitiesRouter::new(), __("Доступные города"));
    }
}
