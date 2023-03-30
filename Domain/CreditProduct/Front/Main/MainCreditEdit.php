<?php

namespace App\Domain\CreditProduct\Front\Main;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\TextAreaLangAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Traits\FastInstantiation;
use App\Domain\CreditProduct\Entity\MainCredit;
use App\Domain\CreditProduct\Front\Dynamic\CreditDynamicIndex;

class MainCreditEdit extends MainCredit implements CreateAttributesInterface
{
    use FastInstantiation;

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new InputLangAttribute("name",
                __("Введите название"), false),
            new TextAreaLangAttribute('helper_text', __("Введите условия"), false),

            InputAttribute::updateAttribute('initial_percent', "number",
                __("Введите первоначальный процент оплаты")),
            CreditDynamicIndex::getDynamic("MainCredit")
        ]);
    }
}
