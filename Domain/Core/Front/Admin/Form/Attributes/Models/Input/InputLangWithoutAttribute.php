<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

class InputLangWithoutAttribute extends InputLangAttribute
{
    public string $name;
    public string $oldKey;

    public function __construct(string $key, string $name, string $oldKey, string $label, bool $create = true, $model = "")
    {
        $this->name = $name;
        $this->oldKey = $oldKey;
        parent::__construct($key, $label, $create, $model);
    }

    public static function inActive()
    {
        $object = new self(...func_get_args());
        $object->active = false;
        return $object;
    }

    public function oldValue()
    {
        return $this->oldKey;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function getVariable($lang = ""): string
    {
        return "$" . $this->key . '["' . $lang . '"]';
    }
}
