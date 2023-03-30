<?php

namespace App\Domain\Core\File\Factory;


use App\Domain\Core\File\Models\Open\FileBladeCreatorOpenCreate;
use App\Domain\Core\File\Models\Open\FileBladeCreatorOpenEdit;
use App\Domain\Core\File\Models\Open\FileBladeCreatorOpenIndex;

abstract class MainOpenFactoryCreator extends MainFactoryCreator
{
    protected function getIndexBladeCreator(): string
    {
        return FileBladeCreatorOpenIndex::class;
    }

    protected function getEditBladeCreator(): string
    {
        return FileBladeCreatorOpenEdit::class;
    }

    protected function getCreateBladeCreator(): string
    {
        return FileBladeCreatorOpenCreate::class;
    }

}
