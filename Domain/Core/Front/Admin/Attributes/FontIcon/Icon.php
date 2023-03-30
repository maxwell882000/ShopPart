<?php

namespace App\Domain\Core\Front\Admin\Attributes\FontIcon;

class Icon extends FontIconAttribute
{
    public function __construct(array $attributes)
    {
        parent::__construct(self::append(['class' => "cursor-pointer text-2xl"], $attributes));
    }

}
