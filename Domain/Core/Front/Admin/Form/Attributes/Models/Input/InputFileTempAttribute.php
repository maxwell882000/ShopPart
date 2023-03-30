<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseInputFileTemp;
use App\Domain\File\Entities\FileTemp;

class InputFileTempAttribute extends BaseInputFileTemp
{
    public function __construct($keyToAttach, $label, bool $create = true, string $mediaInitialKey = "")
    {
        parent::__construct(FileTemp::class, $keyToAttach, $label, false, $create, $mediaInitialKey);
    }
}
