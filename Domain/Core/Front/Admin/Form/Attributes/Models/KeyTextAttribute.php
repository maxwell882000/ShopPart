<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use function Symfony\Component\Translation\t;

class KeyTextAttribute implements HtmlInterface
{
    use AttributeGetVariable;

    protected string $key;
    protected string $value;
    protected string $postfix;
    protected string $class;

    public function __construct(string $key, string $value, string $postfix = "", string $class = "")
    {
        $this->key = $key;
        $this->value = $value;
        $this->postfix = $postfix;
        $this->class = $class;
    }

    static public function new(string $key, string $value, string $postfix = "", string $class = "")
    {
        $class = get_called_class();
        return new $class($key, $value, $postfix, $class);
    }

    protected function value(): string
    {
        return self::getAttributeVariable($this->value);
    }

    public function generateHtml(): string
    {
        return sprintf(
            "<x-helper.text.text_key key=\"%s\" value='%s %s' class_value='%s'></x-helper.text.text_key>",
            $this->key,
            $this->value(),
            $this->postfix,
            $this->class
        );
    }
}
