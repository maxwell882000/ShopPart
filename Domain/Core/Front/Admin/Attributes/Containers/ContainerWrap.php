<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class ContainerWrap extends Container
{
    public function __construct(array $items, array $attributes = [])
    {
        parent::__construct(array_merge([
            Container::new([
                'class' => "w-full"
            ])
        ], $items), self::append([
            'class' => 'flex flex-wrap m-auto justify-start items-end space-x-3 pr-3 space-y-5 w-full',
        ], $attributes));
    }
}
