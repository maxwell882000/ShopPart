<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

abstract class BaseLivewireNestedWithoutEntity extends BaseLivewireNested
{
    public array $addedCheckBox = [];
    public $rules = [];

    public function getLists()
    {
        $entity = $this->getEntity();
        return $entity::filterByIn(['id' => $this->addedCheckBox])->paginate($this->paginate);
    }

    protected function getListAccept()
    {
        $entity = $this->getEntity();
        $withOutSearch = collect($this->filterBy);
        $filterBy = [$this->keySearch => $withOutSearch->pull($this->keySearch)];
        return $entity::filterByNotIn(['id' => $this->addedCheckBox])
            ->filterBy($filterBy)
            ->paginate($this->paginate);
    }

    protected function addToEntity($adding)
    {
        $this->additionalAction::add($this, $adding);
        if (gettype($adding) == "array") {
            $this->addedCheckBox = array_merge_recursive_distinct($adding, $this->addedCheckBox);
        } else if (!in_array($adding, $this->addedCheckBox, true)) {
            array_push($this->addedCheckBox, $adding);
        }

    }

    protected function removeFromEntity($removing)
    {
        $values = $removing;
        $this->additionalAction::delete($this, $removing);
        if (gettype($removing) != "array") {
            $values = [];
            array_push($values, $removing);
        }
        $this->addedCheckBox = array_diff($this->addedCheckBox, $values);

    }

}
