<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes;

use App\Domain\Core\Front\Interfaces\HtmlInterface;
use App\View\Components\Input\InputComponent;

class InputTableAttribute implements HtmlInterface
{
    public string $name;
    public string $type;
    public string $model;
    public string $key;
    public ?bool $defer;
    public ?string $filter;
    public array $attributes;

    public function __construct(string  $name,
                                string  $type,
                                string  $model,
                                string  $key = "",
                                ?bool   $defer = true,
                                ?string $filter = "",
                                array   $attributes = []
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->model = $model;
        $this->key = $key;
        $this->defer = $defer;
        $this->filter = $filter;
        $this->attributes = $attributes;
    }

    public static function generate(string $name, string $type,
                                    string $model, ?bool $defer = true, ?string $filter = "", string $key = "", array $attributes = []): string
    {
        $self = new self($name, $type, $model, $key, $defer, $filter, $attributes);
        return $self->generateHtml();
    }

    public function generateHtml(): string
    {
        $component = new InputComponent($this->name, $this->type, $this->model, $this->key, $this->defer, $this->filter, $this->attributes);
        return $component->render()->with($component->data())->render();
    }
}
