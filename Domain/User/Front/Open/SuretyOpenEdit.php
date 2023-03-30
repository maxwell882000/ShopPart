<?php

namespace App\Domain\User\Front\Open;

use App\Domain\Core\Front\Admin\File\Attributes\FileAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Front\Traits\SuretyGenerationAttributes;

class SuretyOpenEdit extends Surety implements CreateAttributesInterface
{
    use SuretyGenerationAttributes;

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            self::generationSuretyEdit()
        ]);
    }

    public function getPassportReverseEditAttribute()
    {
        return $this->getPassportReverseEdit();
    }

    public function getPassportUserEditAttribute(): FileAttribute
    {
        return $this->getPassportUserEdit();
    }

    public function getPassportEditAttribute(): FileAttribute
    {
        return $this->getPassportEdit();
    }
}
