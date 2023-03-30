<?php

namespace App\Domain\User\Front\Open;

use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Front\Traits\SuretyGenerationAttributes;

class SuretyOpenCreate extends Surety implements CreateAttributesInterface
{
    use SuretyGenerationAttributes;

    public function generateAttributes(): BladeGenerator
    {
        return self::generationSuretyCreate();
    }
}
