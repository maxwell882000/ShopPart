<?php

namespace App\Domain\Installment\Interfaces;

interface TimeScheduleInterface
{
    const SUCCESS = 0;
    const FAILED = 1;
    const FAILED_ALL = 2;
    const FAILED_LOOP = 3;
    const CLIENT = 4;
}
