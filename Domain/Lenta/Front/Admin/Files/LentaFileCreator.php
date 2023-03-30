<?php

namespace App\Domain\Lenta\Front\Admin\Files;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Lenta\Entities\Lenta;
use App\Domain\Lenta\Front\Main\LentaCreate;
use App\Domain\Lenta\Front\Main\LentaEdit;
use App\Domain\Lenta\Front\Main\LentaIndex;

class LentaFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Lenta::class;
    }

    public function getIndexEntity(): string
    {
        return LentaIndex::class;
    }

    public function getCreateEntity(): string
    {
        return LentaCreate::class;
    }

    public function getEditEntity(): string
    {
        return LentaEdit::class;
    }
}
