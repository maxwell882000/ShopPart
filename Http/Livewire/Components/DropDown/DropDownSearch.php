<?php

namespace App\Http\Livewire\Components\DropDown;

use Livewire\Component;

class DropDownSearch extends Component
{

    public string $search = "";
    public string $searchByKey = "";
    public string $dropDownClass = "";
    public $initial = null;
    public string $searchLabel = "";
    public array $filterBy = [];
    public string $prefix = "";
    public string $emiting = "";

    public function updatedSearch()
    {
        $this->filterBy[$this->searchByKey] = $this->search;
        $this->dispatchEvent();
    }

    protected function dispatchEvent()
    {
        $this->dispatchBrowserEvent('search-event');
    }

    public function render()
    {
        return view('livewire.components.drop-down.drop-down-search', [
            "drop" => $this->dropDownClass::getDropDownSearch($this->initial, $this->filterBy, $this->prefix),
        ]);
    }
}
