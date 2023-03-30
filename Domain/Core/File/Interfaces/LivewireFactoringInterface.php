<?php

namespace App\Domain\Core\File\Interfaces;

interface LivewireFactoringInterface extends LivewireCreatorInterface
{
    const FROM_CLASS_FACTORING = self::TEMPLATE_CLASS_PATH . "BaseLivewireFactoring.txt";
    const FROM_BLADE_FACTORING = self::TEMPLATE_BLADE_PATH . "base-template-factoring.blade.php";
}
