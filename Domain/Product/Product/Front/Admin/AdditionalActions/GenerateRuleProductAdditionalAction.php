<?php

namespace App\Domain\Product\Product\Front\Admin\AdditionalActions;

use App\Domain\Core\Front\Admin\Livewire\AdditionalActions\Base\AdditionalActions;
use App\Domain\Product\Product\Front\Admin\Livewire\Attribute\ModelProductAttribute;
use phpDocumentor\Reflection\Types\Self_;

class GenerateRuleProductAdditionalAction extends AdditionalActions
{
    const  NAME = ModelProductAttribute::NAME;

    static public function key($id)
    {
        return self::NAME . "." . $id;
    }

    public function add($object, $id)
    {
        if (gettype($id) == "array") {
            foreach ($id as $value) {
                $name = self::NAME;
                $object->$name[$value] = 1;
                $object->rules[self::key($value)] = "required|numeric";
            }
        } else {
            $name = self::NAME;
            $object->$name[$id] = 1;
            $object->rules[self::key($id)] = "required|numeric";
        }
    }

    public function delete($object, $id)
    {
        if (gettype($id) == "array") {
            foreach ($id as $value) {
                $name = self::NAME;
                unset($object->$name[$value]);
            }
        } else {
            $name = self::NAME;
            unset($object->$name[$id]);
        }
    }
}
