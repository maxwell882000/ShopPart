<?php

namespace App\Domain\Dashboard\File;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Dashboard\Main\DashboardMain;
use App\Domain\Dashboard\Models\Dashboard;

class DashboardCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Dashboard::class;
    }

    public function getIndexEntity(): string
    {
        return DashboardMain::class;
    }

    public function getCreateEntity(): string
    {
        return  '';
    }

    public function getEditEntity(): string
    {
        return  "";
    }
}
