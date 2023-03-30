<?php

namespace App\Domain\Core\Front\Admin\Form\Interfaces;

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

interface ComplexFactoring extends ComplexFactoringConstants
{

    static public function initialize(BaseLivewireFactoring $factoring);

    static public function delete(BaseLivewireFactoring $factoring, $id);

    static public function create(): array;

    // no need of adding id because it is been added in template
    static public function edit(): array;
}
