<?php

namespace App\Domain\Comments\Front\Main;

use App\Domain\Comments\Entities\CommentProduct;
use App\Domain\Comments\Front\Admin\CustomTables\Tables\CommentProductTable;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\StatusAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Interfaces\UserRelationInterface;
use mysql_xdevapi\Exception;

class CommentProductIndex extends CommentProduct implements CreateAttributesInterface, TableInFront
{

    public function getProductNameAttribute()
    {
        return TextAttribute::generation($this, $this->product->title_current, true);
    }

    public function getUserNameAttribute()
    {
        try {
            return TextAttribute::generation($this, $this->user[UserRelationInterface::USER_DATA_SERVICE]->name, true);
        } catch (\Exception $exception) {
            return TextAttribute::generation($this, $this->user->phone, true);
        }
    }

    public function getMessageIndexAttribute()
    {
        return TextAttribute::generation($this, "message");
    }

    public function getStatusIndexAttribute(): string
    {
        return (new StatusAttribute($this, "status", "statusIndex"))
            ->generateHtml();
    }


    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("CommentProduct", $this)
        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getActionsAttribute(): string
    {
        return AllActions::generation([

        ]);
    }

    public function getTableClass(): string
    {
        return CommentProductTable::class;
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
        return "Комментарии продукта";
    }
}
