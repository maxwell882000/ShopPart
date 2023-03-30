<?php

namespace App\Domain\Installment\Entities;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Installment\Builders\CommentInstallmentBuilder;

class CommentInstallment extends Entity
{
    protected $table = "comment_installments";
    public $timestamps = true;

    public function newEloquentBuilder($query)
    {
        return new CommentInstallmentBuilder($query);
    }

    public function getTimeFormatedAttribute()
    {
        return $this->created_at->format("d.m.Y");
    }

    public static function getRules(): array
    {
        return [
            'comment' => "required",
            "time_formated" => ""
        ];
    }
}
