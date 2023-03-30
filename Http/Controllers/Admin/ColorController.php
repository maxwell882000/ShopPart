<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Entities\Category;
use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Common\Colors\Front\Admin\Path\ColorRouteHandler;
use App\Domain\Common\Colors\Services\ColorService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class ColorController extends BaseController
{

    public function getEntityClass(): string
    {
        return Color::class;
    }

    public function getService(): BaseService
    {
        return ColorService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(ColorRouteHandler::new(), "Цвет");
    }

    public function edit(Request $request, Color $color)
    {
        return $this->getEdit($request, $color, [$color]);
    }

    public function update(Request $request, Color $color): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $color);
    }

    public function destroy(Color $color): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($color);
    }
}
