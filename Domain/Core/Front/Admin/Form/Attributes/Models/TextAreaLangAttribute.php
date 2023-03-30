<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputLangAttribute;

class TextAreaLangAttribute extends InputLangAttribute
{
    public function getComponent(): string
    {
        return "<x-helper.text_area.text_area  name='%s[%s]'  label='{{__(\"%s\")}}'>%s</x-helper.text_area.text_area>";
    }

    protected function getContainer(): string
    {
        return "<div class='space-y-2'>%s</div>";
    }
}
