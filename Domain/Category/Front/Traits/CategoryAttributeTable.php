<?php

namespace App\Domain\Category\Front\Traits;

use App\Domain\Category\Front\Admin\Path\SubCategoryRouteHandler;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\OpenAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\StatusAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;

trait  CategoryAttributeTable
{
    public function getIconTableAttribute(): string
    {
        return ImageAttribute::generation($this, 'icon_value');
    }

    public function getIconValueAttribute(): string
    {
        if ($this->icon)
            return $this->icon->icon->storage();
        return "";
    }

    public function getNameTableAttribute(): string
    {
        return TextAttribute::generation($this, "name");
    }

    public function getStatusTableAttribute(): string
    {
        return (new StatusAttribute($this, "status", "statusTable"))
            ->generateHtml();
    }


    // get Open button with all required data
    public function getUnderCategoryTableAttribute(): string
    {
        return OpenAttribute::generation(SubCategoryRouteHandler::new(), $this, $this->childsCategory()->count());
    }
}
