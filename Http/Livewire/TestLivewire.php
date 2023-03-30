<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestLivewire extends Component
{
    public function callFunc() {
        dd("SAADS");
    }
    public function render()
    {
        return view('livewire.asd');
    }
}
