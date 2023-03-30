<?php

namespace App\Domain\User\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\User\Front\AdminMain\AdminCreate;
use App\Domain\User\Front\AdminMain\AdminEdit;
use App\Domain\User\Front\AdminMain\AdminIndex;

class AdminFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return AdminIndex::class;
    }

    public function getIndexEntity(): string
    {
        return AdminIndex::class;
    }

    public function getCreateEntity(): string
    {
        return AdminCreate::class;
    }

    public function getEditEntity(): string
    {
        return AdminEdit::class;
    }
}
