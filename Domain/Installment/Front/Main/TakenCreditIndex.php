<?php

namespace App\Domain\Installment\Front\Main;

use App\Domain\Core\File\Interfaces\BladeActionsInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Installment\Entities\TakenCredit;
use App\Domain\Installment\Front\Admin\CustomTables\Actions\TakenCreditShowAction;
use App\Domain\Installment\Front\Admin\CustomTables\Tables\TakenCreditTable;
use App\Domain\Installment\Front\Traits\TakenIndexTrait;

class TakenCreditIndex extends TakenCredit implements CreateAttributesInterface, BladeActionsInterface
{
    use TakenIndexTrait;

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("TakenCredit", $this),
        ]);
    }

    public function getClientIndexAttribute()
    {
        return TextAttribute::generation($this, $this->userData->name, true);
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, $this->user->phone, true);
    }

    public function getNumProductIndexAttribute()
    {
        return TextAttribute::generation($this, $this[self::PURCHASE_SERVICE]['number_purchase'], true);
    }

    public function getVarTitle(): string
    {
        return "{{__('Рассрочки')}} {{isset(Request::all()['title_for_credit']) ?
            __(Request::all()['title_for_credit']): ''}}";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            TakenCreditShowAction::new([$this->id]),
        ]);
    }

    public function getTableClass(): string
    {
        return TakenCreditTable::class;
    }


    public function getIdPurchaseAttribute()
    {
        return TextAttribute::generation($this, $this->purchase_id, true);
    }


}
