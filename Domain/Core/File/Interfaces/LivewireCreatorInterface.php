<?php

namespace App\Domain\Core\File\Interfaces;

interface LivewireCreatorInterface
{

    const BASE_CLASS = "App/Http/Livewire/Admin/";
    const BASE_BLADE = "resources/views/livewire/admin/";
    /**
     *  FROM_CLASS
     * @params first    --- namespace
     *         second   --- classname livewire
     *         third    --- set of functions and variables
     *         fourth   --- path to blade
     *         fifth    --- variable to blade
     *         sixth    --- optional dropdown items
     *         seventh  --- class name of table
     *         eighth   --- class name of entity
     */
    const CLASS_TEMPLATE = "BaseLivewire.txt";
    const TEMPLATE_CLASS_PATH = self::BASE_CLASS . "Templates/";
    const FROM_CLASS = self::TEMPLATE_CLASS_PATH . self::CLASS_TEMPLATE;

    const BLADE_TEMPLATE = "base-template.blade.php";
    /**
     * @params  first   --- set of functions
     */
    const TEMPLATE_BLADE_PATH = self::BASE_BLADE . "template/";
    const FROM_BLADE = self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE;

    const TO_CLASS = self::BASE_CLASS . "Pages/";
    const TO_BLADE = self::BASE_BLADE . "pages/";

    const INDEX = "Index";

    public function openFile();
}
