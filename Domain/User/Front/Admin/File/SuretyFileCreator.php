<?php

namespace App\Domain\User\Front\Admin\File;

use App\Domain\Core\File\Factory\MainOpenFactoryCreator;
use App\Domain\User\Entities\Surety;
use App\Domain\User\Front\Open\SuretyOpenCreate;
use App\Domain\User\Front\Open\SuretyOpenEdit;
use App\Domain\User\Front\Open\SuretyOpenIndex;

class SuretyFileCreator extends MainOpenFactoryCreator
{

    public function getEntityClass(): string
    {
        return Surety::class;
    }

    public function getIndexEntity(): string
    {
        return SuretyOpenIndex::class;
    }

    public function getCreateEntity(): string
    {
        return SuretyOpenCreate::class;
    }

    public function getEditEntity(): string
    {
        return SuretyOpenEdit::class;
    }
}
