<?php

namespace App\Domain\Common\Api;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Common\Brands\Entities\Brand;

class BrandMain extends Brand
{
    public function toArray()
    {
        return [
            "id" => $this->id,
            "brand" => $this->brand,
            "image" => $this->image->fullPath()
        ];
    }
}
