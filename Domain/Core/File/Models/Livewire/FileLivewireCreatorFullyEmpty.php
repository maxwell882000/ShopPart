<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireCreatorFullyEmpty extends FileLivewireWithoutActionFilterBy
{

    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . FileLivewireEmptyCreator::BLADE_EMPTY;
    }

}
