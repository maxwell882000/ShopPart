<?php

namespace App\Domain\Core\File\Models\Open;

use App\Domain\Core\File\Models\Main\FileBladeCreatorIndex;
use App\Domain\Core\File\Traits\HasRemovedSideBar;

class FileBladeCreatorOpenIndex extends FileBladeCreatorIndex
{
    use HasRemovedSideBar;

    protected function getTemplatePath(): string
    {
        return self::FROM_INDEX_OPEN;
    }

}
