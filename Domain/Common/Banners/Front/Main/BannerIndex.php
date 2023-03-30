<?php

namespace App\Domain\Common\Banners\Front\Main;

use App\Domain\Common\Banners\Entities\Banner;
use App\Domain\Common\Banners\Front\Admin\CustomTable\Actions\BannerDeleteAction;
use App\Domain\Common\Banners\Front\Admin\CustomTable\Actions\BannerEditAction;
use App\Domain\Common\Banners\Front\Admin\CustomTable\Models\BannerTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\StatusAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\DropDown\OptionalItems\ActivateChooseItem;
use App\Domain\Core\Front\Admin\DropDown\OptionalItems\DeactivateChooseItem;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;

class BannerIndex extends Banner implements TableInFront, CreateAttributesInterface
{
    public function getIdIndexAttribute()
    {
        return TextAttribute::generation($this, "id");
    }

    public function getStatusIndexAttribute()
    {
        return StatusAttribute::generation($this, 'status', "statusIndex");
    }

    public function getImageUzIndexAttribute(): string
    {
        return ImageAttribute::generation($this, "image_uz");
    }

    public function getImageRuIndexAttribute(): string
    {
        return ImageAttribute::generation($this, "image_ru");
    }

    public function getImageEnIndexAttribute(): string
    {
        return ImageAttribute::generation($this, "image_en");
    }

    public function getLinkIndexAttribute(): string
    {
        return TextAttribute::generation($this, "link");
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation(
            [
                new FileLivewireCreator("Banner", $this)
            ]);
    }

    public function getTableClass(): string
    {
        return BannerTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return AllLivewireComponents::generation([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return AllLivewireOptionalDropDown::generation([
            ActivateChooseItem::create('status'),
            DeactivateChooseItem::create('status')
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation(
            [

            ]
        );
    }

    public function getTitle(): string
    {
        return "Банер";
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            BannerEditAction::new([$this->id]),
            BannerDeleteAction::new([$this->id])
        ]);
    }
}
