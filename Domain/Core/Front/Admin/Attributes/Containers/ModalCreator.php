<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class   ModalCreator implements HtmlInterface
{
    use GenerateTagAttributes;

    private HtmlInterface $html;
    private ModalContainer $modal;

    public function __construct(HtmlInterface $html, ModalContainer $modal, array $attributes = [])
    {
        $this->html = $html;
        $this->modal = $modal;
        $this->attributes = $attributes;
    }

    static public function new(HtmlInterface $html, ModalContainer $creator, array $attributes = [])
    {
        return new self($html, $creator, $attributes);
    }

    public function generateHtml(): string
    {
        return Container::new(self::append([
            'x-data' => "modalWindow()"
        ], $this->attributes), [
            $this->html,
            $this->modal,
        ])->generateHtml();
    }
}
