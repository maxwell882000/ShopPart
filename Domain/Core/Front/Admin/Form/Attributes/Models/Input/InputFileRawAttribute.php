<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

use App\Domain\Core\Front\Interfaces\HtmlInterface;

class InputFileRawAttribute implements HtmlInterface
{
    public string $label;
    public string $id;

    public function __construct(string $label, string $id)
    {
        $this->label = $label;
        $this->id = $id;
    }

    public function generateHtml(): string
    {
        return "<x-helper.input.input_new_download
        :file=\"[]\"
        uniqueId=" . $this->id . "
        :multiple=\"false\"" . " label=\" " . $this->label . "\"
            />";
    }
}
