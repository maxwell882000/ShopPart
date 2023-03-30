<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Order\Front\Admin\Path\UserPurchaseRouteHandler;
use App\Domain\Order\Services\UserPurchaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;

class NewOrderController extends BaseController
{

    public function getEntityClass(): string
    {
        return UserPurchase::class;
    }

    public function getService(): BaseService
    {
        return UserPurchaseService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(UserPurchaseRouteHandler::new(), "Новые Заказы");
    }
}
