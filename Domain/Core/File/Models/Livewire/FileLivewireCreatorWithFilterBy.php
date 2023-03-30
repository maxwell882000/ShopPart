<?php

namespace App\Domain\Core\File\Models\Livewire;

use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\VariableTransform;

class FileLivewireCreatorWithFilterBy extends FileLivewireCreator
{

    public function generateHtml(): string
    {
        return sprintf(
            '<livewire:admin.pages.%s.%s
            %s />',
            $this->classNameBlade,
            $this->getBladeName(),
            $this->entity->filterByString()
        );
    }

}
