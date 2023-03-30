<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models\Input;

class InputExtendedAttribute extends InputAttribute
{
    public $nameKey;
    public $oldKey;

    /**
     * first key
     * second nameKey
     * third oldKey
     * fourth label
     * @return mixed|void
     */
    static public function inActive()
    {
        $args = func_get_args();
        $object = parent::inActive($args[0], $args[4]);
        $object->nameKey = $args[2];
        $object->oldKey = $args[3];
        return $object;
    }

    public function oldKey()
    {
        return $this->oldKey;
    }

    public function nameKey()
    {
        return $this->nameKey;
    }
}
