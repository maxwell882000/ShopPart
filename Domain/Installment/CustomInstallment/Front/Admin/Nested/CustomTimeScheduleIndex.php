<?php

namespace App\Domain\Installment\CustomInstallment\Front\Admin\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableFilterByInterface;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\OpenButton\Interfaces\FilterInterface;
use App\Domain\Installment\CustomInstallment\Entities\CustomTimeSchedule;
use App\Domain\Installment\Front\Traits\TimeScheduleTrait;

class CustomTimeScheduleIndex extends CustomTimeSchedule implements TableInFront, FilterInterface, TableFilterByInterface
{
    use TimeScheduleTrait;
}
