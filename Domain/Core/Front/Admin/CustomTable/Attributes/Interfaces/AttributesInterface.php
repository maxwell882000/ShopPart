<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Interfaces;


interface AttributesInterface
{
    public function getAttributes($entity): array;


}
