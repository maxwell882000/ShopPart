<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts;


use App\Domain\Core\Front\Admin\CustomTable\Actions\Interfaces\ActionInterface;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\View\Components\Actions\DeleteAction;

abstract class DeleteActionAbstract extends BaseAbstractAction
{

    public function subActionRoute(): string
    {
        return RoutesInterface::DESTROY_ROUTE;
    }

    public function generateHtml(): string
    {
//        dd("asd");
        $delete = new DeleteAction($this->route);
        return $delete->render()->with($delete->data());
    }
}
