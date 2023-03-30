<?php

namespace App\Domain\Settings\Main;

use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerTitle;
use App\Domain\Core\Front\Admin\Blade\Base\AllBladeActions;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Currency\Front\Attributes\CurrencyAttribute;
use App\Domain\Currency\Front\Attributes\MoneyAttribute;
use App\Domain\SchemaSms\Entities\SchemaSmsInstallment;
use App\Domain\SchemaSms\Front\Attribute\SchemaSmsAttribute;

class SettingsIndex extends Entity implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([

        ]);
    }

}
