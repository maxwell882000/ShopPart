<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Interfaces;


interface AttributeInterface
{


    public function getValueOfMainKey();


    static public function generation($entity, $key, $value = false);
}
