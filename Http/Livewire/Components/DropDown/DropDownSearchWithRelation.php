<?php

namespace App\Http\Livewire\Components\DropDown;

use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;
use Livewire\Component;

/**
 * initial must be id of the child
 * so we could reach for the initial of child and parent
 *
 */
class DropDownSearchWithRelation extends DropDownSearch
{
    const SET_PARENT = 1;
    const SET_CHILD = 2;
    public string $dropDownAssociatedClass;
    public array $filterByAssociated = [];
    public string $dispatchClass = Dispatch::class;
    public $parentInitial;

    public function setParent($id)
    {
        if ($this->parentInitial != $id) {
            $this->clear();
            $this->initial = "";
            $this->parentInitial = $id;
            $this->filterByAssociated[$this->dropDownAssociatedClass::parentKey()] = $id;
        }
    }

    public function setChild($id)
    {
        $this->initial = $id;
        $this->dispatchClass::run($this, self::SET_CHILD);
    }

    private function clear()
    {
        try {
            $this->dispatchClass::clear($this);
        } catch (\Error $exception) {
        }
    }

    public function updatingSearch()
    {
        $this->reset(['filterByAssociated', 'parentInitial']);
        $this->clear();
    }

    public function updatedSearch()
    {
        $this->filterBy[$this->searchByKey] = $this->search;
        $this->dispatchEvent();
    }

    public function render()
    {
        return view('livewire.components.drop-down.drop-down-search-with-relation',
            [
                "drop" => $this->dropDownClass::getDropDownSearch($this->parentInitial,
                    $this->filterBy),
                "drop_associated" => $this->dropDownAssociatedClass::getDropDownParent($this->initial,
                    $this->filterByAssociated)
            ]);
    }
}
