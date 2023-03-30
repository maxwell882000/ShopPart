<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Interfaces\AttributeInterface;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseAttributes implements AttributeInterface, HtmlInterface
{
    public $key = "";
    public $entity;
//   value false --- key is property of entity
//  value true ---  key is the actual value to use
    public bool $value;

    public function __construct($entity, $key, $value = false)
    {
        $this->entity = $entity;
        $this->key = $key;
        $this->value = $value;
    }

    public function getValueOfMainKey(): string
    {
        if ($this->value) {
            return $this->key ?? "";
        }
        $key = $this->key;
        return $this->entity->$key ?? "";
    }

    static public function generation($entity, $key, $value = false): string
    {

        $object = new static($entity, $key, $value);
        return $object->generateHtml();
    }
}
