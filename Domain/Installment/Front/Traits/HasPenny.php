<?php

namespace App\Domain\Installment\Front\Traits;

use App\Domain\Core\Front\Admin\Attributes\Conditions\ENDIFstatement;
use App\Domain\Core\Front\Admin\Attributes\Conditions\IFstatement;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\KeyTextAttribute;

trait HasPenny
{
    public function penny()
    {
        return Container::new([], [
            IFstatement::new('$entity->penny'),
            KeyTextAttribute::new("Пенни", "penny_show"),
            ENDIFstatement::new()
        ]);
    }
    public function getPennyShowAttribute() {
        return $this->formatPrice($this->penny);
    }

}
