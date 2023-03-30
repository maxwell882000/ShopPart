<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Traits\InitStaticDropFunction;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseDropDownAttribute extends AbstractDropDown implements HtmlInterface
{
    use InitStaticDropFunction, AttributeGetVariable, GenerateTagAttributes;

    public bool $create;
    public $entity_key = null;

    public function __construct(array $items, $name = null)
    {
        parent::__construct($items, $name);
    }

    public static function new(bool $create = true, array $attributes = [])
    {
        $self = get_called_class();
        $class = new $self([]);
        $class->create = $create;
        $class->attributes = $attributes;
        return $class;
    }


    // put drop down to the blade
    // notice how its getting initial value
    // it is just using the key value so it looks like $entity->$key
    // internally call getDropDown($entity->$key)
    public function generateHtml(): string
    {
        return sprintf("<x-helper.drop_down.drop_down :drop='%s' %s/>",
            $this->initGetDropDown(
                $this->getWithoutScopeAtrVariable($this->entity_key ?? $this->key)
            ),
            $this->generateAttributes()
        );
    }

}
