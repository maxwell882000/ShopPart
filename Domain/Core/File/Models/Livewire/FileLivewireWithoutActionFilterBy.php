<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireWithoutActionFilterBy extends FileLivewireCreatorWithFilterBy
{
    const BLADE_TEMPLATE_WITHOUT_ACTION = "base-template-without-action.blade.php";

    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE_WITHOUT_ACTION;
    }

    protected function formatBlade($file_from): string
    {
        return sprintf($file_from,
            $this->getTableToBlade()
        );
    }
}
