<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;

use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\Domain\Core\Front\Admin\Routes\Models\LinkGenerator;

abstract class AbstractCreateTable extends AbstractTable
{
    use AttributeGetVariable;
    public string $route_create;

    public function __construct($entities = [])
    {
        $this->route_create = self::getScope(LinkGenerator::new($this->getRouteHandler())->create());
        parent::__construct($entities);
    }

    abstract public function getRouteHandler(): RouteHandler;

//    public function generateHtml(): string
//    {
//        return '<x-helper.table.table_form :table="$table" :optional="$optional"/>';
//    }

    public function isCreate()
    {
        return true;
    }
}
