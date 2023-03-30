<?php

namespace App\Domain\Core\File\Models\Main;

class FileBladeCreatorCreateNext extends FileBladeCreatorCreate
{
    protected function getTemplatePath(): string
    {
        return self::FROM_CREATE_NEXT;
    }
}
