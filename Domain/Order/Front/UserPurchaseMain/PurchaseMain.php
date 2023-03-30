<?php

namespace App\Domain\Order\Front\UserPurchaseMain;

use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableFilterByInterface;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\CustomTable\Traits\TableFilterBy;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\OpenButton\Interfaces\FilterInterface;
use App\Domain\Core\Main\Traits\ArrayHandle;
use App\Domain\Order\Entities\Purchase;
use App\Domain\Order\Front\Admin\CustomTables\PurchaseTable;
use App\Domain\Product\Product\Front\Admin\CustomTable\Actions\ProductEditAction;

// Products which was bought , locaiton in intsallment taken credit show
class PurchaseMain extends Purchase implements TableInFront, FilterInterface, TableFilterByInterface
{
    use TableFilterBy, ArrayHandle, AttributeGetVariable;


    public function getNameIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->product->title_current, true);
    }

    public function getNumberIndexAttribute(): string
    {
        return TextAttribute::generation($this, 'quantity');
    }

    public function getShopIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->product->shop->name, true);
    }

    public function getCategoryIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->product->category->name_current, true);
    }

    public function getKeyForFilter(): string
    {
        return "user_purchase_id";
    }

    function filterByData(): array
    {
        return [
            'user_purchase_id' => self::getWithoutScopeAtrVariable("purchase_id"),
        ];
    }

    public function getTableClass(): string
    {
        return PurchaseTable::class;
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

    public function getTitle(): string
    {
        return "";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ProductEditAction::new([$this->product_id])
        ]);
    }
}
