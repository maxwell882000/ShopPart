<?php

namespace App\Http\Livewire\Admin\Pages\AvailableCitiesCRUD;
// 1  --- namespace


use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewireDynamic;

//2 --- classname livewire
class AvailableCityDynamic extends BaseLivewireDynamic
{


    //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.available-cities-crud.available-city-dynamic'; //4  --- path to blade
    }

    public function getVariable()
    {
        $this->includeSearch();
        $table = $this->getTable();
        return [
            "table" => new $table($this->getLists()),
            //5   --- variable to blade
        ];
    }

    public function getItemsToOptionalDropDown(): array
    {
        return [
            // 6  --- optional dropdown items
        ];
    }

    public function getTable()
    {
        return 'App\Domain\Delivery\Front\Admin\Table\AvailableCityTable'; //7  --- class name of table
    }

    public function getEntity()
    {
        return 'App\Domain\Delivery\Front\Admin\Dynamic\AvailableCityDynamic'; //8  --- class name of entity
    }


    public function getServiceClass(): string
    {
        return 'App\Domain\Delivery\Entities\AvailableCities'; //9
    }
}
