<?php

namespace App\Http\Livewire\Components\CurrencyField;

use App\Domain\Currency\Entities\Currency as Curr;
use App\Domain\Currency\Entities\HoldMoney;
use Livewire\Component;

class Money extends Component
{
    public HoldMoney $money;
    public array $rules = [
        'money.hold' => "required|integer|max:10000000"
    ];

    public function mount()
    {
        $this->money = HoldMoney::firstOrCreate(['id' => 1], ['hold' => 0]);
    }

    public function updatedMoney()
    {
        $this->validate($this->rules);
        $this->money->save();
    }

    public function render()
    {
        return view('livewire.components.currency-field.money');
    }
}
