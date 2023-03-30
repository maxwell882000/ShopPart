<?php

namespace App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces;

interface FunctionStandardTemplate
{
    const FUNCTION_TEMPLATE = "public function %s(%s){}";
    const FUNCTION_BODY_NOT_RETURN = "public function %s(%s){ %s}";

    const FUNCTION_BODY = "public function %s(%s){return %s}";
    const FUNCTION_BODY_NO_RETURN = "public function %s(%s){ %s}";
    const VARIABLE_TEMPLATE = "public $%s;";

}
