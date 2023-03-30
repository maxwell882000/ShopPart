<?php

namespace App\Domain\Core\File\Traits;

use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;
use App\Domain\Core\Main\Traits\FastInstantiation;

trait HasCreateTable
{
    use FastInstantiation;

    private function getTable()
    {
        return self::newClass($this->entity->getTableClass());
    }

    private function addCreateButton()
    {
        try {
            $table = $this->getTable();
            if ($table->isCreate()) {
                return sprintf("<div class='self-end'>
                    <x-helper.button.main_button href='%s'>
                              {{__('Создать')}}
                     </x-helper.button.main_button>
                     </div>", $table->route_create);
            }
        }catch (\Exception $exception){

        }
       return  "";
    }
}
