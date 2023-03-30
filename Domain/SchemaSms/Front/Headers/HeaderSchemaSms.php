<?php

namespace App\Domain\SchemaSms\Front\Headers;

class HeaderSchemaSms
{
    public string $name;
    public int $type;
    public array $values;

    public function __construct(string $name, int $type, array $values)
    {
        $this->name = $name;
        $this->type = $type;
        $this->values = $values;
    }
}
