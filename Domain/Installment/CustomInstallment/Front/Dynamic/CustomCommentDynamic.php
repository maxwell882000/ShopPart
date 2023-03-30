<?php

namespace App\Domain\Installment\CustomInstallment\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Installment\CustomInstallment\Builders\CustomCommentInstallmentBuilder;
use App\Domain\Installment\CustomInstallment\Front\Admin\CustomTables\Tables\CustomCommentTable;
use App\Domain\Installment\CustomInstallment\Services\CustomCommentInstallmentService;
use App\Domain\Installment\Front\Dynamic\CommentInstallmentDynamic;

class CustomCommentDynamic extends CommentInstallmentDynamic
{
    protected $table = "custom_comment_installments";
    public static function getCustomRules(): array
    {
        return [
            'created_at' => DynamicAttributes::NOTHING,
            'comment' => DynamicAttributes::INPUT
        ];

    }

    public function newEloquentBuilder($query)
    {
        return new CustomCommentInstallmentBuilder($query);
    }

    public static function getBaseService(): string
    {
        return CustomCommentInstallmentService::class;
    }

    public function getTableClass(): string
    {
        return CustomCommentTable::class;
    }
}
