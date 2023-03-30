<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireDynamicWithoutBoth extends FileLivewireDynamicWithoutEntity
{
    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE_DYNAMIC_WITHOUT_BOTH;
    }

    protected function formatBlade($file_from): string
    {
        return sprintf($file_from,
            $this->getTableToBlade(),
            $this->getPrefixInput()
        );
    }
}
