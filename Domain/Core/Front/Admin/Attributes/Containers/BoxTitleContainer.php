<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class BoxTitleContainer extends ContainerTitle
{
    public static function newTitle(string $title, string $class = '', array $items = [])
    {
        return parent::newTitle($title, $class . " border shadow p-4 space-y-4 bg-white", $items);
    }
}
