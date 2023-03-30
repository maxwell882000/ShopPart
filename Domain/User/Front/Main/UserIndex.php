<?php

namespace App\Domain\User\Front\Main;

use App\Domain\Core\File\Models\Livewire\FileLivewireCreator;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ContainerTextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\ImageAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\OpenAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInFront;
use App\Domain\Core\Front\Admin\Form\Interfaces\CreateAttributesInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;
use App\Domain\Core\Front\Admin\Templates\Models\BladeGenerator;
use App\Domain\User\Entities\User;
use App\Domain\User\Front\Admin\CustomTable\Action\UserEditAction;
use App\Domain\User\Front\Admin\CustomTable\Action\UserShowAction;
use App\Domain\User\Front\Admin\CustomTable\Tables\UserTable;
use App\Domain\User\Front\Admin\Path\SuretyRouteHandler;

class UserIndex extends User implements
    CreateAttributesInterface,
    TableInFront
{

    public function getAvatarIndexAttribute(): string
    {
        $storage = "";
        if (isset($this[self::AVATAR_SERVICE]['avatar'])) {
            $storage = $this[self::AVATAR_SERVICE]->avatar->storage();
        }
        return ImageAttribute::generation($this, $storage, true);
    }

    public function getSuretyIndexAttribute(): string
    {
        return OpenAttribute::generation(SuretyRouteHandler::new(), $this, $this->surety()->count());
    }

    public function getDataIndexAttribute(): string
    {
        return TextAttribute::generation($this, $this->created_at->format("d.m.Y"), true);
    }

    public function getNameIndexAttribute(): string
    {
        $name = "";
        if (isset($this[self::AVATAR_SERVICE])) {
            $name = $this[self::AVATAR_SERVICE]['name'];
        }
//        if (isset($this[self::USER_DATA_SERVICE][self::CRUCIAL_DATA_SERVICE]['name'])) {
//            $name = $this[self::USER_DATA_SERVICE][self::CRUCIAL_DATA_SERVICE]['name'];
//        }
        return TextAttribute::generation($this, $name, true);
    }

    public function getPhoneIndexAttribute(): string
    {
        return TextAttribute::generation($this, "phone");
    }

    public function getStatusIndexAttribute(): string
    {
        $class = "bg-blue-400";
        $text = "Активный";
        if ($this->created_at->format("Y-m-d") == now()->format("Y-m-d")) {
            $class = "bg-green-400";
            $text = "Новый";
        }
        return ContainerTextAttribute::generation($class, new TextAttribute($this, __($text), true));
    }

    public function generateAttributes(): BladeGenerator
    {
        return BladeGenerator::generation([
            new FileLivewireCreator("User", $this)
        ]);
    }

    public function getTableClass(): string
    {
        return UserTable::class;
    }

    public function livewireComponents(): LivewireComponents
    {
        return new AllLivewireComponents([

        ]);
    }

    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return new AllLivewireOptionalDropDown([

        ]);
    }


    public function getActionsAttribute(): string
    {
        $action = [];
        if (isset($this[self::USER_DATA_SERVICE]) && isset($this[self::USER_DATA_SERVICE][self::CRUCIAL_DATA_SERVICE])) {
            $action[] = UserShowAction::new([$this->id]);
        }
        $action[] = UserEditAction::new([$this->id]);
        return AllActions::generation($action);
    }

    public function getTitle(): string
    {
        return "Пользователи";
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }
}
