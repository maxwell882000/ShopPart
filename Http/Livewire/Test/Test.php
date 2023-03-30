<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

class Test extends Component
{
    public int $counter = 0;
    public string $s;
    public string $value;

    public function mount()
    {
        $this->value = "24";
        $this->s = "test.second";
    }

    public function addCounter()
    {
        $this->counter++;
    }

    public function render()
    {
        return view('livewire.test.test');
    }
}
