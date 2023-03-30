<?php

namespace App\Domain\Common\Colors\Front\Admin\File;

use App\Domain\Common\Colors\Entities\Color;
use App\Domain\Common\Colors\Front\Main\ColorCreate;
use App\Domain\Common\Colors\Front\Main\ColorEdit;
use App\Domain\Common\Colors\Front\Main\ColorIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class ColorCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return  Color::class;
    }

    public function getIndexEntity(): string
    {
        return ColorIndex::class;
    }

    public function getCreateEntity(): string
    {
        return ColorCreate::class;
    }

    public function getEditEntity(): string
    {
        return ColorEdit::class;
    }
}
