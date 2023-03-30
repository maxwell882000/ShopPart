<?php

namespace App\Domain\Product\Product\Front\Moderator\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\ModeratorRouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\ModeratorRoutesInterface;

class ModeratorProductRouteHandler extends ModeratorRouteHandler
{

    protected function getName(): string
    {
        return ModeratorRoutesInterface::PRODUCT;
    }
}
