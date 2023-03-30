<?php

namespace App\Http\Controllers\Api\Main;

use App\Domain\Common\Api\BrandMain;
use App\Domain\Common\Banners\Entities\BannerReadOnly;
use App\Domain\Common\Banners\Services\BannerService;
use App\Http\Controllers\Api\Base\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;


class BrandController extends ApiController
{
    public function brand()
    {
        return $this->result(BrandMain::take(12)->get());
    }
}
