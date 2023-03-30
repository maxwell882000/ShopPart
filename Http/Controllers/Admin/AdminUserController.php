<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\Path\AdminUserRouteHandler;
use App\Domain\User\Front\AdminMain\AdminIndex;
use App\Domain\User\Services\AdminService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class AdminUserController extends BaseController
{

    public function getEntityClass(): string
    {
        return AdminIndex::class;
    }

    public function getService(): BaseService
    {
        return AdminService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(AdminUserRouteHandler::new(), "Админ");
    }

    public function edit(Request $request, User $admin_user)
    {
        return $this->getEdit($request, $admin_user, [$admin_user]);
    }

    public function update(Request $request, User $admin_user): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $admin_user);
    }

    public function destroy(User $admin_user): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($admin_user);
    }
}
