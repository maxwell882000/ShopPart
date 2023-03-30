<?php

namespace App\Domain\Installment\Front\Nested;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Installment\Entities\Transaction;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\TransactionTable;

class TransactionIndex extends Transaction implements TableInFront
{
    use TableFilterBy, AttributeGetVariable;

    private $entityId;
    // we get the entity from table itself
    // namely our table works dynamically,
    // so we iterate on each row, and when our action come
    // we create it and pass it here
    // after it will create the view

    public static function new()
    {

        $object = parent::new();
        if (func_num_args() > 0) {
            $entityId = func_get_arg(0)->id;
            $object->setEntityId($entityId);
        }
        return $object;
    }

    function filterByData(): array
    {
        return [
            "month_id" => $this->entityId,
        ];
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getActionsAttribute(): string
    {
        return "";
    }

    public function getTableClass(): string
    {
        return TransactionTable::class;
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

    public function getTitle(): string
    {
        return "История платежей";
    }

    private function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }

    public function getCreatedAtIndexAttribute()
    {
        return TextAttribute::generation($this, $this["created_at"]->format("d.m.Y"), true);
    }

    public function getTypeIndexAttribute()
    {
        return TextAttribute::generation($this, 'type');
    }

    public function getAmountIndexAttribute()
    {
        return TextAttribute::generation($this, 'amount_show');
    }
}
