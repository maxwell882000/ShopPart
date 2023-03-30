<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class ContainerColumn extends Container
{
    public function __construct(array $items, array $attribute)
    {
        parent::__construct($items, $this->append($attribute, ['class' => " flex flex-col  space-y-2"]));
    }
}
