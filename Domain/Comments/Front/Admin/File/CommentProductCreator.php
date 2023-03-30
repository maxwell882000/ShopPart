<?php

namespace App\Domain\Comments\Front\Admin\File;

use App\Domain\Comments\Entities\CommentProduct;
use App\Domain\Comments\Front\Main\CommentProductIndex;
use App\Domain\Core\File\Factory\MainFactoryCreator;

class CommentProductCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return CommentProduct::class;
    }

    public function getIndexEntity(): string
    {
        return CommentProductIndex::class;
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
