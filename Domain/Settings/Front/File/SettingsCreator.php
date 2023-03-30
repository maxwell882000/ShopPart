<?php

namespace App\Domain\Settings\Front\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Settings\Main\SettingsIndex;

class SettingsCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return SettingsIndex::class;
    }

    public function getIndexEntity(): string
    {
        return SettingsIndex::class;
    }

    public function getCreateEntity(): string
    {
        return "";
    }

    public function getEditEntity(): string
    {
        return "";
    }
}
