<?php


namespace App\Domain\Core\Front\Admin\Routes\Abstracts;


use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;

abstract class RouteHandler
{

    abstract protected function getName(): string;

    public function getRoute(string $route): string
    {
        $route = $this->firstName() . $route;
        $exploded = explode(".", $route);

        $exploded[1] = $this->getName();
        return implode(".", $exploded);
    }

    protected function firstName()
    {
        return "admin.";
    }

    public function show()
    {
        return $this->getRoute(RoutesInterface::SHOW_ROUTE);
    }

    public function index()
    {
        return $this->getRoute(RoutesInterface::INDEX_ROUTE);
    }

    public function create()
    {
        return $this->getRoute(RoutesInterface::CREATE_ROUTE);
    }

    public function update()
    {
        return $this->getRoute(RoutesInterface::UPDATE_ROUTE);
    }

    public function edit()
    {
        return $this->getRoute(RoutesInterface::EDIT_ROUTE);
    }

    static function new(): RouteHandler
    {
        return new static();
    }
}
