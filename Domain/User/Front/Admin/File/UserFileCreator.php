<?php

namespace App\Domain\User\Front\Admin\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Main\UserCreate;
use App\Domain\User\Front\Main\UserEdit;
use App\Domain\User\Front\Main\UserIndex;
use App\Domain\User\Front\Main\UserShow;

class UserFileCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return User::class;
    }

    public function getIndexEntity(): string
    {
        return UserIndex::class;
    }

    public function getShowEntity(): string
    {
        return UserShow::class;
    }

    public function getCreateEntity(): string
    {
        return UserCreate::class;
    }

    public function getEditEntity(): string
    {
        return UserEdit::class;
    }
}
