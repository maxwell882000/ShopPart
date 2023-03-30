<?php

namespace App\Domain\Category\Interfaces;

interface CategoryRelationInterface
{
    const CATEGORY_ICON = "icon";
    const CATEGORY_ICON_DATA = self::CATEGORY_ICON_TO . self::CATEGORY_ICON;
    const DELIVERY_IMPORTANT = 'deliveryImportant';
    const DELIVERY_IMPORTANT_TO = self::DELIVERY_IMPORTANT . \CR::CR . "checked";
    const CATEGORY_ICON_TO = self::CATEGORY_ICON . \CR::CR;
    const FILTER = "filterKey";



}
