<?php

namespace App\Domain\Order\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorWithFilterBy;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableFilterByInterface;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\Installment\Front\Admin\CustomTables\Actions\TakenCreditEditAction;
use App\Domain\Installment\Front\Admin\CustomTables\Actions\TakenCreditShowAction;
use App\Domain\Installment\Interfaces\PurchaseStatus;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Order\Front\Admin\CustomTables\UserPurchaseTable;
use App\Domain\Payment\Front\Admin\CustomTables\Actions\PaymentShowAction;

class UserPurchaseIndex extends UserPurchase implements TableInFront, CreateAttributesInterface
{
    use TableFilterBy;

    public function getTypePurchaseAttribute()
    {
        return TextAttribute::generation($this, $this->isInstallment() ?
            __("Рассрочка") : __("Быстрая опалата"), true);
    }

    public function getTypePaymentAttribute()
    {
        return TextAttribute::generation($this, $this->isCash() ?
            __("Наличная оплата") : __("Пластиковая карта"), true);
    }

    public function getIdPurchaseAttribute(): string
    {
        return TextAttribute::generation($this, "id");
    }

    public function getAllSumIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->payble()->price_show, true);
    }

    public function getNumProductIndexAttribute(): string
    {
        return TextAttribute::generation($this, "number_purchase");
    }

    public function getClientIndexAttribute()
    {
        return TextAttribute::generation($this, $this->user->userCreditData->name, true);
    }

    public function getPhoneIndexAttribute()
    {
        return TextAttribute::generation($this, $this->user->phone, true);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation(
            [

            ]
        );
    }

    public function getActionsAttribute(): string
    {
        if ($this->status == self::INSTALMENT || $this->takenCredit()->exists()) {
            return TakenCreditEditAction::new([$this->takenCredit->id])->generateHtml();
        }
        return PaymentShowAction::new([$this->payment->id])->generateHtml();
    }

    public function getTableClass(): string
    {
        return UserPurchaseTable::class;
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
        return "Новые заказы";
    }

    public function filterByData(): array
    {
        return [
            "by_created_at" => true,
            "status" => PurchaseStatus::WAIT_ANSWER,
        ];
    }


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreatorWithFilterBy("UserPurchase", $this)
        ]);
    }
}
