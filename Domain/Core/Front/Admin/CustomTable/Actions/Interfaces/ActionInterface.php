<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Interfaces;


use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

interface ActionInterface
{

    public function getRouteHandler(): RouteHandler;

    public function subActionRoute():string;

    public function buildRoute($route, $params);


}
