<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NewLivewire extends Component
{
    public $checkBox;
    public $checks;
    public int $counter = 0;

    public function mount()
    {
        $this->checkBox = collect([]);
        $this->checks = [];

    }


    public function callFunc()
    {
        $this->counter++;
//        dd($this->checkBox);
//        $this->checks = $this->checkBox;
    }

    public function render()
    {
        return <<<'blade'
            <div>
                <button wire:click="callFunc">asd {{$counter}}</button>
            </div>
        blade;
    }
}
