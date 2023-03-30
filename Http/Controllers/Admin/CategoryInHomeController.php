<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Entities\CategoryInHome;
use App\Domain\Category\Front\Admin\Path\CategoryInHomeRouteHandler;
use App\Domain\Category\Services\CategoryInHomeService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class CategoryInHomeController extends BaseController
{

    public function getEntityClass(): string
    {
        return CategoryInHome::class;
    }

    public function getService(): BaseService
    {
        return CategoryInHomeService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(CategoryInHomeRouteHandler::new(), "Категория для главной странички");
    }

    public function edit(Request $request, CategoryInHome $category_in_home)
    {
        return $this->getEdit($request, $category_in_home, [$category_in_home]);
    }

    public function update(Request $request, CategoryInHome $category_in_home): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $category_in_home);
    }

    public function destroy(CategoryInHome $category_in_home): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($category_in_home);
    }

}
