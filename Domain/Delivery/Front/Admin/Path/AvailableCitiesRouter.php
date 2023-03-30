<?php

namespace App\Domain\Delivery\Front\Admin\Path;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Routing\AdminRoutesInterface;

class AvailableCitiesRouter extends RouteHandler
{

    protected function getName(): string
    {
        return AdminRoutesInterface::AVAILABLE_CITIES;
    }
}
