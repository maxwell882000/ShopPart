<?php

namespace App\Domain\Core\Front\Admin\Attributes\Models;

use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionInterface;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class Column implements FunctionInterface
{
    public string $column_name;
    public string $key_to_row;

    public function __construct($column_name, $key_to_row)
    {
        $this->column_name = $column_name;
        $this->key_to_row = $key_to_row;
    }

    public function generateFunction(): string
    {
        return "";
    }

    public static function new($column_name, $key_to_row): Column
    {
        return new self($column_name, $key_to_row);
    }
}
