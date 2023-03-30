<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts;

use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\View\Components\Actions\ViewAction;

abstract  class ShowActionAbstract extends BaseAbstractAction
{
    public function subActionRoute(): string
    {
        return RoutesInterface::SHOW_ROUTE;
    }

    public function generateHtml(): string
    {
        $delete = new ViewAction($this->route);
        return $delete->render()->with($delete->data());
    }
}
