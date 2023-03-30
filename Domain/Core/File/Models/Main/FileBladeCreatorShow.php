<?php

namespace App\Domain\Core\File\Models\Main;

use App\Domain\Core\File\Abstracts\AbstractFileManagerBlade;

class FileBladeCreatorShow extends AbstractFileManagerBlade
{

    protected function getPath(): string
    {
        return $this->pathMain . self::SHOW;
    }

    protected function formatFile($file_from): string
    {
        return sprintf($file_from,
            $this->getTitle(),
            $this->bladeGenerator->generateHtml(),
        );
    }

    protected static function getScope($value)
    {
        return $value;
    }

    protected function getTemplatePath(): string
    {
        return self::FROM_SHOW;
    }
}
