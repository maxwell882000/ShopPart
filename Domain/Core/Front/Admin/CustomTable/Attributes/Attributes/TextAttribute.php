<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\BaseAttributes;

use App\View\Components\Text\TextTableComponent;

class TextAttribute extends BaseAttributes
{
    public function generateHtml():string
    {
        $text = new TextTableComponent($this->getValueOfMainKey());
        return $text->render()->with($text->data());
    }
}
