<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Admin\Path\SubCategoryRouteHandler;
use App\Domain\Category\Front\SubCategory\SubCategory;
use App\Domain\Category\Services\CategoryService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseOpenController;
use App\Http\Requests\Admin\ParamsRequest;
use Illuminate\Http\Request;

class SubCategoryController extends BaseOpenController
{
    public function getEntityClass(): string
    {
        return SubCategory::class;
    }

    public function getForm(): AbstractForm
    {
        return new FormForModel(SubCategoryRouteHandler::new(), __("Под Категории"));
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

    public function update(Request $request, SubCategory $sub_category)
    {
        return $this->getUpdateValidation($request, $sub_category);
    }

    public function edit(ParamsRequest $request, SubCategory $sub_category)
    {
        return $this->getEdit(
            $request,
            $sub_category,
            [$sub_category]
        );
    }

    public function destroy(Category $sub_category): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($sub_category);
    }

    public function getService(): BaseService
    {
        return new CategoryService();
    }

}
