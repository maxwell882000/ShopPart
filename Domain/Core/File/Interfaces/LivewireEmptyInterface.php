<?php

namespace App\Domain\Core\File\Interfaces;

use App\Domain\Core\File\Models\Livewire\FileLivewireEmptyCreator;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionGeneratorInterface;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

interface LivewireEmptyInterface extends CreateAttributesInterface, FunctionGeneratorInterface, HtmlInterface
{
}
