<?php

namespace App\Domain\Installment\Front\Dynamic;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\DynamicAttributes;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableDynamic;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Installment\Entities\CommentInstallment;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\CommentInstallmentTable;
use App\Domain\Installment\Services\CommentInstallmentService;

class CommentInstallmentDynamic extends CommentInstallment implements TableInFront
{
    use TableDynamic;

    public static function getCustomRules(): array
    {
        return [
            'time_formated' => DynamicAttributes::NOTHING,
            'comment' => DynamicAttributes::TEXT_AREA
        ];
    }


    public function getTitle(): string
    {
        return "Комментарии";
    }

    public static function getBaseService(): string
    {
        return CommentInstallmentService::class;
    }

    public static function getDynamicParentKey(): string
    {
        return 'taken_credit_id';
    }

    public function getTableClass(): string
    {
        return CommentInstallmentTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([

        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
