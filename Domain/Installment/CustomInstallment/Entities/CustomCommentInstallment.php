<?php

namespace App\Domain\Installment\CustomInstallment\Entities;

use App\Domain\Installment\CustomInstallment\Builders\CustomCommentInstallmentBuilder;
use App\Domain\Installment\Entities\CommentInstallment;

class CustomCommentInstallment extends CommentInstallment
{
    protected $table = "custom_comment_installments";

    public function newEloquentBuilder($query)
    {
        return new CustomCommentInstallmentBuilder($query);
    }
}
