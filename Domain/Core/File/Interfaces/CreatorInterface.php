<?php

namespace App\Domain\Core\File\Interfaces;

interface CreatorInterface extends FactoryFileInterface
{
    public function getEntityClass(): string;

    public function getIndexEntity(): string;

    public function getCreateEntity(): string;

    public function getEditEntity(): string;

    public function getShowEntity(): string;
}
