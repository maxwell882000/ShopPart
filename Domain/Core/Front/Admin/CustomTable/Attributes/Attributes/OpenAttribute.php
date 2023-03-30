<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes;

use App\Domain\Core\Front\Admin\Routes\Abstracts\RouteHandler;
use App\Domain\Core\Front\Admin\Routes\Interfaces\RoutesInterface;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use App\View\Components\Actions\BlueOpen;

class OpenAttribute implements HtmlInterface
{
    public string $href;

    public string $slot;

    public function __construct(RouteHandler $handler, $entity, string $slot)
    {
        $this->slot = $slot;
        $this->href = route($handler->getRoute(
            RoutesInterface::INDEX_ROUTE),
            ['params' => $entity->id]);
    }

    public static function generation(RouteHandler $handler, $entity, string $slot): string
    {
        $self = new self($handler, $entity, $slot);
        return $self->generateHtml();
    }

    public function generateHtml(): string
    {
        $button = new BlueOpen($this->slot, $this->href);
        return $button->render()->with($button->data());
    }
}
