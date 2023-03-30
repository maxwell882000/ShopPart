<?php

namespace App\Domain\CreditProduct\Front\Main;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Dynamic\CreditDynamicWithoutEntity;

class MainCreditCreate extends MainCredit implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("name",
                __("Введите название")),
            new TextAreaLangAttribute('helper_text', __("Введите условия")),
            InputAttribute::createAttribute('initial_percent', "number",
                __("Введите первоначальный процент оплаты")),
            CreditDynamicWithoutEntity::getDynamic("MainCredit")
        ]);
    }
}
