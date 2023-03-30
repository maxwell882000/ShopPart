<?php

namespace App\Domain\Common\Discounts\Front\Main;

use App\Domain\Common\Discounts\Entities\Discount;
use App\Domain\Common\Discounts\Front\Admin\CustomTables\Actions\DiscountDeleteAction;
use App\Domain\Common\Discounts\Front\Admin\CustomTables\Actions\DiscountEditAction;
use App\Domain\Common\Discounts\Front\Admin\CustomTables\Tables\DiscountTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\StatusAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableActionInterface;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class DiscountIndex extends Discount implements CreateAttributesInterface, TableActionInterface
{

    public function getStatusTableAttribute(): string
    {
        return (new StatusAttribute($this, "status", "statusTable"))
            ->generateHtml();
    }
    public function getDesImageRuIndexAttribute(): string
    {
        return ImageAttribute::generation($this,
            $this->des_image_ru->storage(), true);
    }

    public function getDesImageUzIndexAttribute(): string
    {
        return ImageAttribute::generation($this,
            $this->des_image_uz->storage(), true);
    }

    public function getMobImageRuIndexAttribute(): string
    {
        return ImageAttribute::generation($this,
            $this->mob_image_ru->storage(), true);
    }

    public function getMobImageUzIndexAttribute(): string
    {
        return ImageAttribute::generation($this,
            $this->mob_image_uz->storage(), true);
    }

    public function getPercentIndexAttribute(): string
    {
        return TextAttribute::generation($this, "percent");
    }

    public function getNumberProductIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->product()->count(), true);
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("Discount", $this)
        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            DiscountEditAction::new([$this->id]),
            DiscountDeleteAction::new([$this->id])
        ]);
    }

    public function getTableClass(): string
    {
        return DiscountTable::class;
    }
}
