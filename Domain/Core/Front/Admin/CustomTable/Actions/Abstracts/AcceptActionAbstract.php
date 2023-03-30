<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts;


use App\Domain\Core\Front\Admin\CustomTable\Actions\Interfaces\ActionInterface;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\View\Components\Actions\AcceptAction;

abstract class  AcceptActionAbstract extends BaseAbstractAction
{
    public function subActionRoute(): string
    {
        return Routes::ACCEPT;
    }

    public function generateHtml(): string
    {
        $accept_action = new AcceptAction($this->route);
        return $accept_action->render()->with($accept_action->data());
    }
}
