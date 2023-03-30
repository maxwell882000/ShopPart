<?php

namespace App\Domain\Core\File\Models\Livewire;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class LivewireDynamic implements HtmlInterface
{
    public string $path;
    public $args;

    public function __construct(FileLivewireCreator $creator)
    {
        $this->path = $creator->generateHtmlPath();
        $this->args = $creator->getArgs();
    }

    public function generateHtml(): string
    {
//        dd($this->args);
        return \Livewire\Livewire::mount($this->path, [$this->args])->html();
    }
}
