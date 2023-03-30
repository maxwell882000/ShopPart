<?php

namespace App\Domain\Core\Front\Admin\DropDown\OptionalItems;

use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireOptional;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\VariableTransform;

class ActivateChooseItem extends DropLivewireOptional
{
    use VariableTransform;

    private string $variable;

    public function __construct()
    {
        parent::__construct();
    }

    static public function create($variable)
    {
        $called = get_called_class();
        $object = new $called();
        $object->variable = $variable;
        return $object;
    }

    public function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_BODY,
            $this->getFunctionName(),
            $this->formatArguments(),
            $this->body()
        );
    }

    protected function primitiveBody(): string
    {
        return $this->createVariables("$--this->getEntity()::whereIn('id', $--this->checkBox)
            ->update(
                ['%s' => %s]
            );
        $--this->checkBox = [];");
    }

    protected function body($boolean = 'true'): string
    {
        return sprintf($this->primitiveBody(), $this->variable, $boolean);
    }

    static protected function getName(): string
    {
        return __("Активровать выбранные");
    }

    static public function getFunctionName(): string
    {
        return "activateChosen";
    }

    static public function getArguments(): array
    {
        return [];
    }
}
