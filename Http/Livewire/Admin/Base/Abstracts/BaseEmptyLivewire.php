<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

use App\Domain\Core\Front\Admin\DropDown\Models\PaginatorDefault;
use Livewire\Component;

abstract class BaseEmptyLivewire extends Component
{
    public $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view($this->getPath(), $this->getVariable());
    }

    abstract function getPath(): string;

    abstract function getVariable(): array;

}
