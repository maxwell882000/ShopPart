<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Form\Models\FormForModel;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Front\Admin\Path\ShopRouteHandler;
use App\Domain\Shop\Services\ShopService;
use App\Http\Controllers\Base\Abstracts\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductEditRequest;
use App\Http\Requests\Admin\ShopCreateRequest;
use App\Http\Requests\Admin\ShopEditRequest;
use Illuminate\Http\Request;

class ShopController extends BaseController
{

    public function getEntityClass(): string
    {
        return Shop::class;
    }

    public function getService(): BaseService
    {
        return ShopService::new();
    }

    public function getForm(): AbstractForm
    {
        return FormForModel::new(ShopRouteHandler::new(), __("Магазин"));
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

    public function edit(Request $request, Shop $shop)
    {
        return $this->getEdit($request, $shop, [$shop]);
    }

    public function update(Request $request, Shop $shop)
    {
        return $this->getUpdateValidation($request, $shop);
    }

    public function destroy(Request $request, Shop $shop)
    {
        return $this->getDestroy($shop);
    }
}
