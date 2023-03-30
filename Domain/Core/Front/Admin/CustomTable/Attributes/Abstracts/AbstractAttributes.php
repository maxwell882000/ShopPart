<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts;


use App\Domain\Core\Front\Admin\CustomTable\Attributes\Interfaces\AttributesInterface;

abstract class AbstractAttributes implements AttributesInterface
{
    public $attribute;
    public $actions;

    public function __construct($entity)
    {
        $this->attribute = $this->getAttributes($entity);
    }
}
