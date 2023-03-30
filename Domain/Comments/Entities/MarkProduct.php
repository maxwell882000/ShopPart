<?php

namespace App\Domain\Comments\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Traits\HasCompositePrimaryKey;

class MarkProduct extends Entity
{
    use HasCompositePrimaryKey;

    protected $table = "mark_product";
    protected $fillable = [
        "mark",
        "user_id",
        "product_id"
    ];
    public $incrementing = false;
    public $primaryKey = ['user_id', 'product_id'];

}
