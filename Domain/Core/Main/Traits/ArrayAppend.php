<?php

namespace App\Domain\Core\Main\Traits;

use Illuminate\View\ComponentAttributeBag;

trait ArrayAppend
{
    static protected function append($attribute, array $append): array
    {
        foreach ($attribute as $key => $value) {
            $append_value = "";
            if (isset($append[$key])) {
                $append_value = $append[$key];
                unset($append[$key]);
            }
            $attribute[$key] = $value . ' ' . $append_value;
        }
        return array_merge($attribute, $append);
    }


}
