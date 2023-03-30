<?php

namespace App\Domain\Core\File\Interfaces;

interface LivewireCreatorNestedInterface
{
    /**
     *  FROM_CLASS
     * @params first    --- namespace
     *         second   --- classname livewire
     *         third    --- set of functions and variables
     *         fourth   --- path to blade
     *         fifth    --- variable to blade
     *         sixth    --- optional accept dropdown items
     *         seventh  --- optional decline dropdown items
     *         eighth  --- class name of table
     *         ninth   --- class name of entity
     *         tenth    --- class name of decline table
     */
    const CLASS_TEMPLATE_NESTED = "BaseLivewireNested.txt";
    const BLADE_TEMPLATE_NESTED  = "base-template-nested.blade.php";

    const CLASS_TEMPLATE_NESTED_WITHOUT = "BaseLivewireNestedWithoutEntity.txt";
    const BLADE_TEMPLATE_NESTED_WITHOUT  = "base-tempate-nested-without-entity.blade.php";

    public function getTableDeclineClass(): string;
}
