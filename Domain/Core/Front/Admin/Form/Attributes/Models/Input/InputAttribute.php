<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseAttributeFromText;

class InputAttribute extends BaseAttributeFromText
{

    private function getValue()
    {
        if ($this->type == "password") {
            return "";
        }
        return sprintf('{{old("%s") ?? %s}}', $this->oldKey(), $this->getVariable());
    }

    public function oldKey()
    {
        return $this->key;
    }

    public function nameKey()
    {
        return $this->key;
    }

    // change dispatches depending on type
    public function generateHtml(): string
    {
        if ($this->type == "checkbox") {
            $dispatch = sprintf('onchange="%s"', $this->createDispatch());
        } else {
            $dispatch = sprintf("onkeyup=\"%s\"", $this->createDispatch());
        }
        return sprintf("<x-helper.input.input%s name='%s' type='%s'
            label='{{__(\"%s\")}}' value='%s' id='%s' oninput='%s' placeholder='%s'  %s %s %s/>",
            $this->type == "checkbox" ? "_checked" : "",
            $this->nameKey(),
            $this->type,
            $this->label,
            $this->getValue(),
            $this->id,
            $this->filter,
            $this->placeholder,
            $dispatch,
            $this->isActive(),
            $this->generateAttributes()
        );
    }
}
