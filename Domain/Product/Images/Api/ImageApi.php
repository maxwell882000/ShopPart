<?php

namespace App\Domain\Product\Images\Api;

use App\Domain\Product\Images\Entities\Image;

class ImageApi extends Image
{
    public function toArray()
    {
        return $this->image->fullPath();
    }
}
