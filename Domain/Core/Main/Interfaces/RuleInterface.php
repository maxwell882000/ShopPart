<?php

namespace App\Domain\Core\Main\Interfaces;

interface RuleInterface
{
    static public function getRules(): array;

    static public function getCreateRules(): array;

    static public function getUpdateRules(): array;
}
