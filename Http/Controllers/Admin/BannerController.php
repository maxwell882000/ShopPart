<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Category\Entities\Category;
use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Common\Banners\Front\Admin\Path\BannerRouteHandler;
use App\Domain\Common\Banners\Services\BannerService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class BannerController extends BaseController
{

    public function getEntityClass(): string
    {
        return Banner::class;
    }

    public function getService(): BaseService
    {
        return BannerService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(BannerRouteHandler::new(), __("Баннер"));
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

    public function edit(Request $request, Banner $banner)
    {
        return $this->getEdit($request, $banner, [$banner]);
    }

    public function update(Request $request, Banner $banner): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $banner);
    }

    public function destroy(Banner $banner): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($banner);
    }
}

