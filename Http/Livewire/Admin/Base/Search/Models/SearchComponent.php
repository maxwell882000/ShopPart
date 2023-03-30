<?php


namespace App\Http\Livewire\Admin\Base\Search\Models;


use App\Http\Livewire\Admin\Base\Search\Interfaces\SearchLivewire;
use Livewire\Component;

abstract class SearchComponent extends Component implements SearchLivewire
{
    public $search;

    public function render()
    {
        return view($this->path(), $this->search());
    }

}
