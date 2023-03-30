<?php

namespace App\Domain\Core\Front\Admin\Routes\Models;

use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\Domain\Core\Main\Traits\ArrayHandle;

class LinkGenerator
{
    use ArrayHandle, AttributeGetVariable;

    private RouteHandler $handler;

    public function __construct(RouteHandler $handler)
    {
        $this->handler = $handler;
    }

    static public function new(RouteHandler $handler): LinkGenerator
    {
        return new self($handler);
    }

    public function show(string $id): string
    {
        return $this->route(RoutesInterface::SHOW_ROUTE, [self::getWithoutScopeAtrVariable($id)]);
    }

    public function create()
    {
        return $this->route(RoutesInterface::CREATE_ROUTE);
    }

    public function index(array $params = []): string
    {
        return $this->route(RoutesInterface::INDEX_ROUTE, $params);
    }

    public function route(string $route, array $params = []): string
    {
        return sprintf("route(\"%s\", array_merge(%s, \Request::query()))",
            $this->handler->getRoute($route),
            $this->arrayToStringWithoutQuotes($params));
    }
}
