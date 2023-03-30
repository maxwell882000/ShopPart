<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Models;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;

class UploadVariable implements LivewireAdditionalFunctions
{

    public function generateFunctions(): string
    {
        return VariableGenerator::new([
            'fileCustom; use \Livewire\WithFileUploads'
        ])->generateFunctions();
    }
}
