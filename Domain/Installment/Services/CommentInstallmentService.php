<?php

namespace App\Domain\Installment\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Installment\Entities\CommentInstallment;
use Illuminate\Support\Facades\DB;

class CommentInstallmentService extends BaseService
{

    public function getEntity(): Entity
    {
        return CommentInstallment::new();
    }

}
