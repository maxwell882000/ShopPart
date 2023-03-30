<?php

namespace App\Domain\Core\Front\Admin\DropDown\Abstracts;

use App\Domain\Core\Front\Admin\DropDown\Traits\InitStaticDropFunction;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionHelperStaticInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionFormatArg;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\FunctionGenerate;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class AbstractLivewireDropDown extends AbstractDropDown
    implements HtmlInterface, FunctionInterface, FunctionHelperStaticInterface, FunctionStandardTemplate
{
    const  FORMAT_CLICK = "%s(%s)";

    use FunctionFormatArg, FunctionGenerate, InitStaticDropFunction;

    public function generateFunction(): string
    {
        return sprintf($this->getTemplate(),
            $this->getFunctionName(),
            $this->formatArguments(),
            $this->setBodyFunction()
        );
    }
    protected function getTemplate() {
        return self::FUNCTION_BODY;
    }
    protected function setBodyFunction(): string
    {
        return $this->toThisVariable() . '=' . '$' . $this->getArguments()[0] . ";";
    }

    protected function initializeFunction(): string
    {
        return $this->initGetDropDown($this->toThisVariable());
    }

    public function setKey(): string
    {
        return "";
    }

    public function setType(): string
    {
        return "";
    }

    static public function formatClick($value): string
    {
        $class = get_called_class();
        return sprintf(self::FORMAT_CLICK,
            $class::getFunctionName(), $value);
    }
    public function generateHtml(): string
    {
        $class = get_called_class();
        return sprintf("<x-helper.drop_down.drop_down_livewire :drop='%s' />",
            self::toRealBlade($class::getVariableBlade()));
    }
}
