<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\Path\UserRouteHandler;
use App\Domain\User\Front\Main\UserEdit;
use App\Domain\User\Services\UserService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    //
    public function getEntityClass(): string
    {
        return User::class;
    }

    public function getService(): BaseService
    {
        return new UserService();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(UserRouteHandler::new(), __("Пользователя"));
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

    public function edit(Request $request, UserEdit $user)
    {
        return $this->getEdit($request, $user, [$user]);
    }
    public function show(Request $request, User $user) {
        return $this->getShow($request, $user);
    }
    public function update(Request $request, User $user)
    {
        return $this->getUpdateValidation($request, $user);
    }


}
