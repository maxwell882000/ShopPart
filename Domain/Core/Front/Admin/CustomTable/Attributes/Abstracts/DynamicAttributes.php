<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts;

use App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDownAttributeTable;

abstract class DynamicAttributes
{
    const INPUT = "1";
    const TEXT_AREA = "4";
    const DROP_DOWN = "2";
    const NOTHING = "3";

    public static function INPUT(string $rules): string
    {
        return self::INPUT . "|" . $rules;
    }

    /**
     * $class is attribute which will be instantiated
     */
    public static function DROP_DOWN(string $class, string $rules = ""): string
    {
        if (!is_subclass_of($class, AbstractDropDownAttributeTable::class))
            throw new DynamicTableException(
                sprintf("First paremeter must be the class which extends %s",
                    AbstractDropDownAttributeTable::class));

        return self::DROP_DOWN . "|" . $class . "|" . $rules;
    }
}
