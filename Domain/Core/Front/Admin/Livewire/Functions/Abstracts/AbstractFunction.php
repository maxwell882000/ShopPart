<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Abstracts;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;

abstract class AbstractFunction implements LivewireAdditionalFunctions, FunctionStandardTemplate
{

    private function generateMethods($class, $method_name): string
    {
        $reflection = new \ReflectionMethod($class, $method_name);
        if ($reflection->isPublic() && $reflection->isStatic() && $reflection->name != "new")
            return sprintf(self::FUNCTION_BODY,
                $method_name,
                "",
                sprintf('\\%s::%s($this,...func_get_args());', $class, $method_name)
            );
        return "";
    }

    static public function new(): AbstractFunction
    {
        $self = get_called_class();
        return new $self();
    }

    public function generateFunctions(): string
    {
        $self = get_called_class();
        $methods = get_class_methods($self);
        $str = "";
        foreach ($methods as $method) {
            $str = $str . $this->generateMethods($self, $method);
        }
        return $str;
    }
}
