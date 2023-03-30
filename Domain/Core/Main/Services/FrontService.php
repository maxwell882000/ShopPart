<?php

namespace App\Domain\Core\Main\Services;

use App\Domain\Core\Main\Entities\Entity;

class FrontService extends BaseService
{
    private $class_name;

    public function __construct($class_name)
    {
        $this->class_name = $class_name;
        parent::__construct();
    }

    public function getEntity():Entity
    {
        return new $this->class_name();
    }
}
