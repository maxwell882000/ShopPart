<?php

namespace App\Domain\Product\Product\Front\Moderator\Pages;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Product\Product\Front\Main\ProductIndex;
use App\Domain\Product\Product\Front\Moderator\CustomTable\Actions\ModeratorProductDeleteAction;
use App\Domain\Product\Product\Front\Moderator\CustomTable\Actions\ModeratorProductEditAction;
use App\Domain\Product\Product\Front\Moderator\CustomTable\Tables\ModeratorProductTable;

class ModeratorProductIndex extends ProductIndex
{

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ModeratorProductEditAction::new([$this->id]),
            ModeratorProductDeleteAction::new([$this->id]),
        ]);
    }

    public function getTableClass(): string
    {
        return ModeratorProductTable::class;
    }
}
