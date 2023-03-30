<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireDynamicIndexWithoutContainer extends FileLivewireDynamicWithoutContainer
{
    public function generateAdditionalToHtml(): string
    {
        return "";
    }
}
