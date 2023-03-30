<?php

namespace App\Domain\Core\File\Factory;

use App\Domain\Core\File\Models\Moderators\FBCModeratorCreate;
use App\Domain\Core\File\Models\Moderators\FBCModeratorCreateNext;
use App\Domain\Core\File\Models\Moderators\FBCModeratorEdit;
use App\Domain\Core\File\Models\Moderators\FBCModeratorIndex;
use App\Domain\Core\File\Models\Moderators\FBCModeratorShow;

abstract class MFCModerator extends MainFactoryCreator
{
    protected function getIndexBladeCreator(): string
    {
        return FBCModeratorIndex::class;
    }

    protected function getEditBladeCreator(): string
    {
        return FBCModeratorEdit::class;
    }

    protected function getCreateBladeCreator(): string
    {
        return FBCModeratorCreate::class;
    }

    protected function getShowBladeCreator(): string
    {
        return FBCModeratorShow::class;
    }

    protected function getCreateNextBladeCreator(): string
    {
        return FBCModeratorCreateNext::class;
    }
}
