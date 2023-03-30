<?php

namespace App\Domain\Core\Front\Admin\Form\Traits;

trait AttributeGetVariable
{
    static protected function getAttributeVariable($value): string
    {
        return self::getScope(self::getWithoutScopeAtrVariable($value));
    }

    static protected function getScope($value)
    {
        return sprintf('{{%s ?? ""}}', $value);
    }

    static protected function lang($value)
    {
        return sprintf("{{__('%s')}}", $value);
    }

    static protected function   getWithoutScopeAtrVariable($value): string
    {
        return sprintf('%s->%s', self::getEntityVariable(), $value);
    }

    static protected function getEntityVariable()
    {
        return '$entity';
    }
}
