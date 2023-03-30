<?php

namespace App\Domain\Core\Front\Admin\DropDown\OptionalItems;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;

class DeactivateChooseItem extends ActivateChooseItem
{
    public function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_BODY,
            $this->getFunctionName(),
            $this->formatArguments(),
            $this->body('false')
        );
    }

    static protected function getName(): string
    {
        return __("Деактивировать выбранные");
    }

    static public function getFunctionName(): string
    {
        return "deactivateChosenItem";
    }

}
