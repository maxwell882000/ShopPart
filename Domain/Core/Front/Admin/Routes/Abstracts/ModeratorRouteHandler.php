<?php

namespace App\Domain\Core\Front\Admin\Routes\Abstracts;

abstract class ModeratorRouteHandler extends RouteHandler
{
    protected function firstName()
    {
        return "moderator.";
    }
}
