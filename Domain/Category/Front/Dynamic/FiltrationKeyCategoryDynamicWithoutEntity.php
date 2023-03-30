<?php

namespace App\Domain\Category\Front\Dynamic;

use App\Domain\Category\Front\Admin\CustomTable\Tables\FiltrationKeyCategoryTable;
use App\Domain\Category\Interfaces\CategoryRelationInterface;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use App\Domain\Product\ProductKey\Front\Traits\TextDynamicWithoutEntity;

class FiltrationKeyCategoryDynamicWithoutEntity extends ProductKey implements TableInFront
{
    use TextDynamicWithoutEntity;


    static public function getPrefixInputHidden(): string
    {
        return CategoryRelationInterface::FILTER;
    }


    public function getTitle(): string
    {
        return 'Фильтрация для продуктов';
    }

    public function getTableClass(): string
    {
        return FiltrationKeyCategoryTable::class;
    }

}
