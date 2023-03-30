<?php

namespace App\Domain\Core\Front\Admin\Button\Traits;

use App\Domain\Core\Main\Traits\ArrayAppend;

trait GenerateTagAttributes
{
    use ArrayAppend;

    protected array $attributes = [];


    /**
     * @return string
     */
    protected function generateAttributes(): string
    {
        $str = "";
        foreach ($this->attributes as $key => $attribute) {
            if ($attribute == null) {
                $str = $str . " " . $key;
            } else {
                $str = sprintf("%s\t%s='%s'", $str, $key, $attribute);
            }
        }
        return $str;
    }
}
