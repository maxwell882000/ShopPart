<?php

namespace App\Domain\Core\File\Models\Main;

use App\Domain\Core\File\Abstracts\AbstractFileManagerBlade;

class FileBladeCreatorCreate extends AbstractFileManagerBlade
{

    protected function getPath(): string
    {
        return $this->pathMain . self::CREATE;
    }
    protected function formatFile($file_from): string
    {
        return sprintf($file_from,
            $this->bladeGenerator->generateHtml(),
        );
    }

    protected function getTemplatePath(): string
    {
        return self::FROM_CREATE;
    }
}
