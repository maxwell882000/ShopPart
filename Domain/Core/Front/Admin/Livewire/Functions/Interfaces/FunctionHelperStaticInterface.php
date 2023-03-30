<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces;

interface FunctionHelperStaticInterface
{

    static public function getFunctionName(): string;

    static public function getArguments(): array;
}
