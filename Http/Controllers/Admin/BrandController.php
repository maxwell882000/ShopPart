<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Common\Brands\Front\Admin\Path\BrandRouteHandler;
use App\Domain\Common\Brands\Services\BrandService;
use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use Illuminate\Http\Request;

class BrandController extends BaseController
{

    public function getEntityClass(): string
    {
        return Brand::class;
    }

    public function getService(): BaseService
    {
        return BrandService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(BrandRouteHandler::new(), "Брэнд");
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

    public function edit(Request $request, Brand $brand)
    {
        return $this->getEdit($request, $brand, [$brand]);
    }

    public function update(Request $request, Brand $brand): \Illuminate\Http\RedirectResponse
    {
        return $this->getUpdateValidation($request, $brand);
    }

    public function destroy(Brand $brand): \Illuminate\Http\RedirectResponse
    {
        return $this->getDestroy($brand);
    }
}
