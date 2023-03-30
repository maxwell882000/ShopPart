<?php

namespace App\Domain\Product\Product\Front\Admin\Functions;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Domain\Product\ProductKey\Entities\ProductKey;
use App\Domain\Product\ProductKey\Entities\ProductKeyReadOnly;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class FromCategory extends AbstractFunction
{
    const FUNCTION_NAME = "fromCategory";
    private BaseLivewireFactoring $livewire;
    private Collection $productKeys;

    public function init(BaseLivewireFactoring $livewire, $id)
    {
        $this->setLivewire($livewire);
        $this->productKeys = Category::find($id)->filterKey;
    }

    private function setLivewire(BaseLivewireFactoring $livewireFactoring)
    {
        $this->livewire = $livewireFactoring;
    }

    public function addToObjects()
    {
        foreach ($this->productKeys as $item) {
            $this->livewire->objects[$this->livewire->counter] = $item->attributesToArray();
            $this->livewire->counter++;
        }
    }

    public function removePreviousCategoryObjects()
    {
        foreach ($this->livewire->objects as $key => $item) {
            if (isset($item['id']) && $item['id']) {
                $this->livewire->objects->pull($key);
            }
        }
    }

    public function mapObjects($collect = "objects")
    {
        foreach ($this->livewire->$collect as $key => $object) {
            if (gettype($object) == "array")
                $this->livewire->$collect[$key] = new ProductKeyReadOnly($object);
        }
    }


    static public function fromCategory(BaseLivewireFactoring $livewire, $id)
    {
        $object = new self();
        $object->init($livewire, $id);
        $object->removePreviousCategoryObjects();
        $object->addToObjects();
    }

    static public function fillObjects(BaseLivewireFactoring $livewireFactoring, $value)
    {
        $livewireFactoring->objects[$value] = [
            "id" => old("productKey->{$value}->id"),
            "text" => old("productKey->{$value}->text"),
        ];
    }

    static public function render(BaseLivewireFactoring $livewireFactoring)
    {
        $object = new self();
        $object->setLivewire($livewireFactoring);
        $object->mapObjects();
        $object->mapObjects("entities");
        return view($livewireFactoring->getPath());
    }
}
