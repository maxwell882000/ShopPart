<?php

namespace App\Domain\Core\Front\Admin\File\Base;

use App\Domain\Core\Front\Admin\File\Interfaces\FileInterface;

abstract class BaseFileAttribute implements FileInterface
{
    protected $entity;
    protected string $key;
    public string $id;

    public function __construct($entity, $key, string $id)
    {
        $this->entity = $entity;
        $this->key = $key;
        $this->id = $id;
    }

}
