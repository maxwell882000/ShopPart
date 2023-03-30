<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;

abstract class BaseAttributeFromText extends BaseAttributeForm
{
    use GenerateTagAttributes;

    public string $type;
    public string $dispatch;
    public string $filter;
    public bool $active = true;
    public string $placeholder;

    public function createDispatch(): string
    {
        if ($this->dispatch) {
            return sprintf('$dispatch(\'%s\', {
               data:{
                    value: event.target.value
               }
            })', $this->dispatch);
        }
        return "";

    }

    public static function new(string $key, string $type, string $label, string $id = "", string $dispatch = "")
    {
        $self = get_called_class();
        return (new $self($key, $type, $label, true, $id, $dispatch))->generateHtml();
    }

    /**
     * $key -- first argument
     * $label -- second argument
     * @return mixed
     */
    public static function inActive()
    {
        $arg = func_get_args();
        $self = get_called_class();
        $object = new $self($arg[0], "text", $arg[1], true);
        $object->active = false;
        return $object;
    }

    public function isActive()
    {
        if (!$this->active)
            return "disabled";
        return "";
    }

    public static function init(string $key, string $type, string $label, array $attribute = [])
    {
        $obj = new static($key, $type, $label);
        $obj->attributes = $attribute;
        return $obj;
    }

    public static function createAttribute(string $key, string $type, string $label,
                                           string $id = "",
                                           string $dispatch = "",
                                           string $filter = "",
                                           string $placeholder = ""
    )
    {

        return new static($key, $type, $label, true, $id, $dispatch, $filter, $placeholder);
    }

    public static function updateAttribute(string $key, string $type, string $label,
                                           string $id = "", string $dispatch = "", string $filter = "")
    {
        return new static($key, $type, $label, false, $id, $dispatch, $filter);
    }

    public function __construct(string $key, string $type, string $label,
                                bool   $create = true, $id = "",
                                string $dispatch = "", $filter = "", $placeholder = "")
    {
        parent::__construct($key, $label, $create, $id,);
        $this->type = $type;
        $this->dispatch = $dispatch;
        $this->filter = $filter;
        $this->placeholder = $placeholder;
    }
}
