<?php

namespace App\Domain\Core\Front\Admin\Form\Models;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;

class FormForModel extends AbstractForm
{
    private $route;
    private $const_title;

    public function __construct(RouteHandler $route, string $const_title)
    {
        $this->route = $route;
        $this->const_title = $const_title;
        parent::__construct();
    }

    protected function getRouteHandler(): RouteHandler
    {
        return $this->route;
    }

    protected function getTitle(): string
    {
        return $this->const_title;
    }

    public static function new(RouteHandler $route, string $const_title)
    {

        return new self($route, $const_title);
    }
}
