<?php

namespace App\Domain\Common\Banners\Entities;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class BannerReadOnly extends Banner
{
    public function toArray()
    {

        return [
            "id" => $this->id,
            "link" => $this->link,
            "image" => Request::has("isMobile") && Request::query('isMobile')  == "true" ? $this->getImageMobileCurrentAttribute()->fullPath() : $this->getImageCurrentAttribute()->fullPath()
        ];
    }

    public static function getCreateRules(): array
    {
        return [
            "image" => "required"
        ];
    }
}
