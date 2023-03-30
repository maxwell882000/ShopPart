<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

use App\Domain\Core\Main\Traits\FastInstantiation;
use App\Http\Livewire\Admin\Base\Rules\GenerateRules;
use Illuminate\Support\Collection;

/*
 * rules are not made
 * */


abstract class BaseLivewireDynamic extends BaseLivewire
{
    use FastInstantiation, GenerateRules;

    public $parentId = 0;

    /**
     * parent key used for insertion and filtration also for deletion
     */
    public string $parentKey = "";
    public Collection $entity;
    public Collection $collection;
    public array $storedValues = []; //

    public function mount()
    {
        parent::mount();
        $this->setCollections();
        $this->generateRules('entity.');
        $this->setTemplateInput();
        $this->setInitialValues();
    }

    private function setInitialValues()
    {
        $this->filterBy[$this->parentKey] = $this->parentId;
    }

    private function setCollections()
    {
        $this->collection = collect([]);
        $this->entity = collect([]);

    }

    private function setTemplateInput()
    {
        $table = self::newClass($this->getTable(), []);
        $this->storedValues = $table->inputs;
    }


    public function update($id)
    {
        try {
            $this->validateRules('collection.' . $id . ".");
            $object = $this->collection->pull($id);
            $entity = $this->findEntity($id);
            $this->getService()->update($entity, $object);
            $this->dispatchBrowserEvent('show-inputs', ['id' => $id, 'show' => false]);
        } catch (\Throwable $exception) {
            $this->addError("error", $exception->getMessage());
        }
    }

    public function delete($id)
    {
        $entity = $this->findEntity($id);
        $this->getService()->destroy($entity);
    }

    protected function validateRules(string $rules)
    {
        $new_rules = [];
        foreach ($this->getEntity()::getRules() as $key => $value) {
            $new_rules[$rules . $key] = $value;
        }
        $this->validate($new_rules);
    }

    public function cancel($id)
    {
        $this->collection->pull($id);
        $this->dispatchBrowserEvent('show-inputs', ['id' => $id, 'show' => false]);
    }

    protected function findEntity($id)
    {
        return $this->getEntity()::find($id);
    }

    protected function setCollection($entity, $id)
    {
        $this->collection[$id] = $entity->attributesToArray();
    }

    public function addToUpdate($id)
    {

        $entity = $this->findEntity($id);
        $this->setCollection($entity, $id);
        $this->generateRules("collection." . $id . ".");
        $this->dispatchBrowserEvent('show-inputs', ['id' => $id, 'show' => true]);
    }

    public function save()
    {
        try {
            $this->validateRules('entity.');
            $this->entity[$this->parentKey] = $this->parentId;
            $this->getService()->create($this->entity->toArray());
            $this->entity = collect([]);
        } catch (\Throwable $validator) {
            $this->addError("error", $validator->getMessage());
        }

    }


    public function getService()
    {
        return self::newClass($this->getServiceClass());
    }

    abstract public function getServiceClass(): string;
}
