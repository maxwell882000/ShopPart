<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Comments\Entities\CommentProduct;
use App\Domain\Comments\Front\Admin\Path\CommentProductRouteHandler;
use App\Domain\Comments\Services\CommentProductService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;

class CommentProductController extends BaseController
{

    public function getEntityClass(): string
    {
        return CommentProduct::class;
    }

    public function getService(): BaseService
    {
        return CommentProductService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(CommentProductRouteHandler::new(), "Комментарий");
    }

}
