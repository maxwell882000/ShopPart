<?php

namespace App\Domain\Core\File\Traits;

use App\View\Helper\Sidebar\Models\Moderator\ModeratorSideBar;

trait HasModeratorSideBar
{
    protected function sideBarName(): string
    {
        return ModeratorSideBar::class;
    }

    protected function putInDirectory()
    {
        return "moderator";
    }

    protected function headerName()
    {
        return "header_moderator";
    }
}
