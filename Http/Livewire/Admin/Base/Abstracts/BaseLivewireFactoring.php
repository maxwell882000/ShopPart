<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

use App\Http\Livewire\Admin\Base\Rules\GenerateRules;
use Illuminate\Support\Collection;
use Livewire\Component;

// when object is deleted
// delete counter increased
// so, we do not need to remap other objects
abstract class BaseLivewireFactoring extends Component
{
    use GenerateRules;

    public $counter = 0;
    public $entityId;
    public $className;
    public string $prefix = '';
    public string $prefixKey;
    public string $initialSettingClass;

    public Collection $entities; // for already existing data
    public Collection $objects; // for new data
    public $entity;

    /**
     * @param null $entity
     * @param string $key -- used for initial counter and for prefixing
     */
    public function mount($rules = [])
    {
        $this->entities = collect([]);
        $this->objects = collect([]);
        $this->initializeClass();
        $this->generateOld();
        $this->baseGenerateRules("objects.", $rules);
    }


    protected function initializeClass()
    {
        if ($this->initialSettingClass) {
            $this->initialSettingClass::initialize($this);
        }
    }

    protected function generateOld()
    {
        if (old($this->prefixKey . '_new_created')) {
            foreach (old($this->prefixKey . '_new_created') as $value) {
                $this->fillObjects($value);
                $this->counter++;
            }
        }
    }

    protected function fillObjects()
    {
        $value = func_get_args()[0];
        $this->objects[$value] = [];
    }

    public function addCounter()
    {
        $this->objects[$this->counter] = [];
        $this->counter++;
    }

    public function remove($id)
    {
        $this->objects->pull($id);
    }

    public function removeEntity($id)
    {
        $this->initialSettingClass::delete($this, $id);
    }


    public function render()
    {

        return view($this->getPath());
    }

    abstract function getPath();
}
