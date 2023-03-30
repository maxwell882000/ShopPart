<?php

namespace App\Domain\SchemaSms\Interfaces;

interface SchemaSmsStatus
{
    const REMAINDER_PAYMENT = 1;
    const DAY_OF_PAYMENT = 2;
    const EXPIRED_PAYMENT = 3;
    const AFTER_PAYMENT = 4;
}
