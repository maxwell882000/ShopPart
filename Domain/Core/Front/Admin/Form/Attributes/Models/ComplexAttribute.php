<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\File\Models\Livewire\FileLivewireFactoring;
use App\Domain\Core\Front\Admin\Attributes\Containers\NestedContainer;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class ComplexAttribute extends BladeGenerator
{
    public string $title;
    public string $key;

    protected function __construct($title, array $items, $key)
    {
        $this->title = $title;
        $this->key = $key;
        parent::__construct($items);
    }

    public static function generation(array $items, string $title = "", string $key = ""): BladeGenerator
    {
        return new self($title, $items, $key);
    }

    public function generateHtml(): string
    {
        return sprintf("<div wire:key='%s'> %s </div>", $this->key, NestedContainer::new
        ($this->title, $this->items, [
            'class'=> "space-y-6"
        ])->generateHtml());
    }
}
