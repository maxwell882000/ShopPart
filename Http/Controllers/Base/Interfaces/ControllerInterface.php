<?php

namespace App\Http\Controllers\Base\Interfaces;

use App\Domain\Core\Front\Admin\CustomTable\Abstracts\AbstractTable;

use App\Domain\Core\Front\Admin\Form\Abstracts\AbstractForm;
use App\Domain\Core\Main\Services\BaseService;

interface ControllerInterface
{
    // for path generation
    public function getEntityClass(): string;

    public function getService(): BaseService;

    public function getForm(): AbstractForm;

}
