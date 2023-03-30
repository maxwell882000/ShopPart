<?php

namespace App\Domain\Policies\Front\Admin\Files;

use App\Domain\Core\File\Factory\MainFactoryCreator;
use App\Domain\Policies\Entity\Policy;
use App\Domain\Policies\Front\Main\PolicyCreate;
use App\Domain\Policies\Front\Main\PolicyEdit;
use App\Domain\Policies\Front\Main\PolicyIndex;

class PolicyCreator extends MainFactoryCreator
{

    public function getEntityClass(): string
    {
        return Policy::class;
    }

    public function getIndexEntity(): string
    {
        return PolicyIndex::class;
    }

    public function getCreateEntity(): string
    {
        return PolicyCreate::class;
    }

    public function getEditEntity(): string
    {
        return PolicyEdit::class;
    }
}
