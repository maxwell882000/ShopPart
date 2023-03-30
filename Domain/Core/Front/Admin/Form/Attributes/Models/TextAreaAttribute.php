<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;


use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseAttributeForm;

class TextAreaAttribute extends BaseAttributeForm
{
    use GenerateTagAttributes;

    public function __construct(string $key, string $label, bool $create = true, string $id = "", $attributes = [])
    {
        $this->attributes = $attributes;
        parent::__construct($key, $label, $create, $id);
    }

    private function setVariable()
    {
        if ($this->key) {
            return sprintf("{{%s}}", sprintf('old("%s") ?? %s', $this->key, $this->getVariable()));
        }
        return "";
    }

    public function generateHtml(): string
    {

        return sprintf("<x-helper.text_area.text_area name='%s' label='%s' %s>%s</x-helper.text_area.text_area>",
            $this->key,
            $this->label,
            $this->generateAttributes(),
            $this->setVariable()
        );
    }
}
