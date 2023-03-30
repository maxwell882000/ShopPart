<?php

namespace App\Http\Livewire\Components\CurrencyField;

use  \App\Domain\Currency\Entities\Currency as Curr;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Currency extends Component
{
    public string $currency = "";
    public Curr $last;

    public function mount()
    {
        $this->last = Curr::last();
        $this->currency = $this->last->price ?? 0;
    }

    public function updatedCurrency()
    {
        if (now()->toDate()->format('Y-m-d') == $this->last->date) {
            $this->last->price = intval($this->currency);
            $this->last->save();
        } else {
            $this->last = Curr::create([
                'price' => $this->currency,
                'date' => now()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.components.currency-field.currency');
    }
}
