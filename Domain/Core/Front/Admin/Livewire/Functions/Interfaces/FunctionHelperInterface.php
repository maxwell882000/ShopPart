<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces;

interface FunctionHelperInterface
{
     public function getFunctionName(): string;

     public function getArguments(): array;
}
