<?php

namespace App\Domain\Policies\Front\Main;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Policies\Entity\Policy;

class PolicyCreate extends Policy implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new TextAreaLangAttribute("policies", "Введите политика и конфиденциальность"),
        ]);
    }
}
