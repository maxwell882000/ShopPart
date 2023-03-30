<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Interfaces;


use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

interface MainActionInterface
{
    public function click();

    public function getIcon():int;

    public function getRouteHandler(): RouteHandler;

    public function subActionRoute();

    public function buildRoute($route, $params);

}
