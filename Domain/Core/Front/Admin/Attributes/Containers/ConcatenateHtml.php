<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

use App\Domain\Core\Front\Interfaces\HtmlInterface;
use Illuminate\Support\Facades\Blade;

class ConcatenateHtml implements HtmlInterface
{
    private array $tags;

    public function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    static public function new(array $tags)
    {
        return new self($tags);
    }
    public function render() {
        return Blade::render($this->generateHtml());
    }
    public function generateHtml(): string
    {
        $str = "";
        foreach ($this->tags as $tag) {
            $str = $str . " " . $tag->generateHtml();
        }
        return Blade::compileString($str);
    }
}
