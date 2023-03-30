<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireDynamicWithoutContainer extends FileLivewireDynamic
{
    protected function getPathFromBlade(): string
    {
        return  self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE_DYNAMIC_WITHOUT_CONTAINER;
    }
    protected function formatBlade($file_from): string
    {
        return sprintf($file_from,
            $this->getTableToBlade()
        );
    }
}
