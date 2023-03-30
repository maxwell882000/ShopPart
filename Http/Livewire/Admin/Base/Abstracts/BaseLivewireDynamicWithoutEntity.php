<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

use App\Domain\Core\Main\Services\EmptyService;
use App\Domain\Core\Main\Traits\HasPopKey;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

// be cautious to put something in guard condition
// because through array will be impossible to populate
abstract class BaseLivewireDynamicWithoutEntity extends BaseLivewireDynamic
{
    use HasPopKey;

    const PRIMARY_KEY = 'id';
    public int $counter = 0; // counter only used to replace id
    public Collection $saved;
    public string $className; // used to get getPrefixInputHidden()
    public string $parentKey;

    public function mount(Collection $initial = null)
    {
        parent::mount();
        $this->className = $this->getEntity();
        if ($initial && $initial->isNotEmpty()) {
            $this->saved = $initial->map(function ($item) {
                return [
                    $item[self::PRIMARY_KEY] => $item->toArray()
                ];
            });
        } else {
            $this->saved = collect([]); // loop id is key and argument
        }
        $old = old();
        if (isset($old)) {
            $oldKey = sprintf($this->parentKey, $this->index ?? 0);
            $oldValues = $this->popConditionMultiple($old, explode(\CR::CR, $oldKey));
            for ($i = 1; !empty($oldValues); $i++) {
                $data = $this->popCondition($oldValues, $i);
                if (!empty($data))
                    $this->saved[$i] = $data;
            }
        }
        $this->counter = $this->saved->sortBy('id')->last()['id'] ?? 0;
    }

    public function update($id)
    {
        $this->validateRules('collection.' . $id . ".");
        $this->saved[$id] = $this->collection->pull($id);
        $this->dispatchBrowserEvent('show-inputs', ['id' => $id, 'show' => false]);
    }

    public function delete($id)
    {
        $this->saved->pull($id);
    }

    protected function getLists()
    {
        return new LengthAwarePaginator($this->saved->map(function ($item) {
            $object = self::newClass($this->getEntity(), $item);
            $object->id = $item[self::PRIMARY_KEY];
            return $object;
        }), $this->saved->count(), $this->paginate, $this->page);
    }

    protected function findEntity($id)
    {
        return $this->saved[$id];
    }

    protected function setCollection($entity, $id)
    {
        $this->collection[$id] = $entity;
    }

    public function save()
    {
        $this->validateRules('entity.');
        $this->entity[self::PRIMARY_KEY] = ++$this->counter;
        $this->saved[$this->counter] = $this->entity->toArray();
        $this->entity = collect([]);

    }

    public function getServiceClass(): string
    {
        return EmptyService::class;
    }
}
