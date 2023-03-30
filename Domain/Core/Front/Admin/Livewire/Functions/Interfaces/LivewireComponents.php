<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces;

interface LivewireComponents
{
    public function generateFunctions(): string;

    public function initializeVariables(): string;

    public function generateBlades(): string;
}
