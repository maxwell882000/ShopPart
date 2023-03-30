<?php

namespace App\Domain\SchemaSms\Front\Attribute;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class SchemaSmsAttribute implements HtmlInterface
{
    public string $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    static public function new(string $class): SchemaSmsAttribute
    {
        return new self($class);
    }
    static public function generate(string $class): string
    {
        return self::new($class)->generateHtml();
    }
    public function generateHtml(): string
    {
        return sprintf(
            "<livewire:components.schema-sms.schema-sms-livewire selected_class='%s' />",
            $this->class
        );
    }
}
