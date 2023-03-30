<?php

namespace App\Domain\Core\Front\Admin\Attributes\Models;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Front\Admin\Livewire\Functions\Traits\VariableTransform;

class LivewireStatusColumn extends LivewireColumn
{
    use VariableTransform;

    private string $actual_key;

        public function __construct($column_name, $key_to_row, $actual_key)
    {
        $this->actual_key = $actual_key;
        parent::__construct($column_name, $key_to_row);
    }

    function generateFunction(): string
    {
        return sprintf(FunctionStandardTemplate::FUNCTION_BODY_NOT_RETURN,
            $this->getFunctionName(),
            $this->formatArguments(),
            $this->body()
        );
    }

    protected function primitiveBody(): string
    {
        return '$entity = $this->getEntity()::find($%s);
             $entity->%s = !$entity->%s;
             $entity->save();';
    }

    protected function body(): string
    {
        return sprintf($this->primitiveBody(), self::ARGUMENT,
            $this->actual_key,
            $this->actual_key
        );
    }
}
