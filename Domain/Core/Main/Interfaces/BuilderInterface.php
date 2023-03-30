<?php

namespace App\Domain\Core\Main\Interfaces;

interface BuilderInterface
{
    public function filterBy($params);

    public function filterByNot($params);

    public function deleteIn(array $keys);
}
