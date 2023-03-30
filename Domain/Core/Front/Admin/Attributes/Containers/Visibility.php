<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class Visibility extends Container
{

    public static function generateVisibility($name_listener = "", array $items = [], array $attributes = []): string
    {
        return self::newVisibility($name_listener, $items, $attributes)->generateHtml();
    }

    public static function newVisibility($name_listener = "", array $items = [], array $attributes = []): Container
    {
        return self::new(self::append($attributes, [
            'x-data' => "{show: false}",
            'class' => 'w-full',
            ':class' => 'show && " " || "hidden"'
        ]), [
            Container::new(
                [
                    sprintf('@%s.window', $name_listener) => 'show = !show'
                ],
                $items
            )
        ]);
    }
}
