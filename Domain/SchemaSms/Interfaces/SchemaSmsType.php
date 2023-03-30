<?php

namespace App\Domain\SchemaSms\Interfaces;

interface SchemaSmsType extends SchemaSmsStatus
{
    const TYPE_NAME = 0;
    const TYPE_NUMBER_ORDER = 1;

}
