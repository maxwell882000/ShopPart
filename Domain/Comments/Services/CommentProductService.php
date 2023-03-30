<?php

namespace App\Domain\Comments\Services;

use App\Domain\Comments\Entities\CommentProduct;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;

class CommentProductService extends BaseService
{

    public function getEntity(): Entity
    {
        return  new CommentProduct();
    }
}
