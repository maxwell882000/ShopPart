<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Traits;

use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;

trait FunctionGenerate
{
    /*
     *  in livewire
     * */
    abstract static public function getVariable(): string;

    abstract static public function getVariableBlade(): string;

    static public function toRealBlade($variable_blade): string
    {
        return "$" . $variable_blade;
    }

    protected function toThisVariable(): string
    {
        return "$" . "this" . "->" . $this->getVariable();
    }

    /**
     * @return mixed
     * function is required when we want to send return value of the variable to
     * the blade
     * for example we want to send to the blade dropdown
     */
    abstract protected function initializeFunction();

    /**
     * sends initialized variable to the blade
     */
    public function generateInitialization(): string
    {
        return sprintf("'%s' => %s", $this->getVariableBlade(), $this->initializeFunction());
    }

    public function generateVariable(): string
    {
        return sprintf(FunctionStandardTemplate::VARIABLE_TEMPLATE, $this->getVariable());
    }


}
