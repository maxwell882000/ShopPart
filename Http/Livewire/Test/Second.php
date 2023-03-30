<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

class Second extends Component
{
    public int $counter = 0;
    public string $value;

    public function counterP()
    {
        $this->counter++;
    }

    public function render()
    {
        return view('livewire.test.second');
    }
}
