<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Actions\Abstracts;


use App\View\Components\Actions\DenyAction;

abstract class DenyActionAbstract extends BaseAbstractAction
{


    public function subActionRoute(): string
    {
        return self::DENY;
    }

    public function generateHtml(): string
    {
        $deny = new DenyAction($this->route);
        return $deny->render()->with($deny->data());
    }
}
