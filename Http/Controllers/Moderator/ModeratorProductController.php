<?php

namespace App\Http\Controllers\Moderator;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Front\Admin\Routes\Routing\ModeratorRoutesInterface;
use App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler;
use App\Http\Controllers\Admin\ProductController;

class ModeratorProductController extends ProductController
{
    public function getForm(): AbstractForm
    {
        return FormForModel::new(ModeratorProductRouteHandler::new(), __("Товар"));
    }

    protected function putInDirectory()
    {
        return ModeratorRoutesInterface::MODERATOR;
    }
}
