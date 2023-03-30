<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

class KeyTextValueAttribute extends KeyTextAttribute
{
    protected function value(): string
    {
        return $this->value;
    }
}
