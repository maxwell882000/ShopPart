<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Front\Admin\Path\CategoryAllRouteHandler;
use App\Domain\Category\Front\Admin\Path\CategoryRouteHandler;
use App\Domain\Category\Front\All\AllCategory;
use App\Domain\Category\Services\CategoryService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;

class AllCategoryController extends CategoryController
{
    public function getEntityClass(): string
    {
        return AllCategory::class;
    }
}
