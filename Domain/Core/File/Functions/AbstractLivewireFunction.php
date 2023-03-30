<?php

namespace App\Domain\Core\File\Functions;

use App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts\AbstractFunction;
use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireFactoring;

abstract class AbstractLivewireFunction extends AbstractFunction
{
    private BaseLivewireFactoring $livewire;


    abstract protected function mapObjectClass():string;

    public function setLivewire(BaseLivewireFactoring $livewireFactoring)
    {
        $this->livewire = $livewireFactoring;
    }




    public function mapObjects($collect = "objects")
    {
        $class = $this->mapObjectClass();
        foreach ($this->livewire->$collect as $key => $object) {
            if (gettype($object) == "array")
                $this->livewire->$collect[$key] = new $class($object);
        }
    }


    static public function fillObjects(BaseLivewireFactoring $livewireFactoring, $value)
    {
        $livewireFactoring->objects[$value] = [];
    }

    static public function render(BaseLivewireFactoring $livewireFactoring)
    {
        $self = get_called_class();
        $object = new $self();
        $object->setLivewire($livewireFactoring);
        $object->mapObjects("entities");
        $object->mapObjects();
        return view($livewireFactoring->getPath());
    }
}
