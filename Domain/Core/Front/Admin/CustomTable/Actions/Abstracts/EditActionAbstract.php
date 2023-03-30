<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts;


use App\Domain\Core\Front\Admin\CustomTable\Actions\Interfaces\ActionInterface;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\View\Components\Actions\DenyAction;
use App\View\Components\Actions\EditAction;

abstract class EditActionAbstract extends BaseAbstractAction
{

    public function subActionRoute(): string
    {
        return RoutesInterface::EDIT_ROUTE;
    }

    public function generateHtml(): string
    {
        $edit = new EditAction($this->route);
        return $edit->render()->with($edit->data());
    }
}
