<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;

use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;

class KeyTextLinkAttribute extends KeyTextAttribute
{
    use AttributeGetVariable;

    public string $link;

    public static function newLink(string $key, string $value, string $link)
    {
        $object = parent::new($key, $value);
        $object->link = $link;
        return $object;
    }

    protected function generateLink()
    {
        return $this->link;
    }

    protected function value():string
    {
        return self::getAttributeVariable($this->value);
    }

    public function generateHtml(): string
    {
        return sprintf(
            "<x-helper.text.text_key_link key='%s' value='%s' :link='%s'></x-helper.text.text_key_link>",
            $this->key,
            $this->value(),
            $this->generateLink()
        );
    }
}
