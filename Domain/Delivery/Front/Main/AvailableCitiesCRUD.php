<?php

namespace App\Domain\Delivery\Front\Main;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Delivery\Entities\AvailableCities;
use App\Domain\Delivery\Front\Admin\Dynamic\AvailableCityDynamic;

class AvailableCitiesCRUD extends AvailableCities implements CreateAttributesInterface
{

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            Container::new(['class'=>'w-full'], [
                AvailableCityDynamic::getDynamicIndexWithoutContainer("AvailableCitiesSimple")
            ]),
        ]);
    }
}
