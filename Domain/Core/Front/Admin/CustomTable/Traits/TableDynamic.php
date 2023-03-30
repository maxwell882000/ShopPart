<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\File\Models\Livewire\FileLivewireDynamic;
use App\Domain\Core\File\Models\Livewire\FileLivewireDynamicIndexWithoutContainer;
use App\Domain\Core\File\Models\Livewire\FileLivewireDynamicWithoutContainer;

trait TableDynamic
{
    use TableDynamicWithoutEntity;

    public static function getDynamicIndexWithoutContainer($className, $parentId = "id"): FileLivewireDynamicIndexWithoutContainer
    {
        return new FileLivewireDynamicIndexWithoutContainer(
            $className,
            new static(),
            static::getBaseService(),
            static::getDynamicParentKey(),
            $parentId
        );
    }

    public static function getDynamicWithoutContainer($className, $parentId = "id"): FileLivewireDynamic
    {
        return new FileLivewireDynamicWithoutContainer(
            $className,
            new static(),
            static::getBaseService(),
            static::getDynamicParentKey(),
            $parentId
        );
    }

    public static function getDynamic($className, $parentId = "id"): FileLivewireDynamic
    {
        $class = get_called_class();
        return new FileLivewireDynamic(
            $className,
            new $class(),
            static::getBaseService(),
            static::getDynamicParentKey(),
            $parentId
        );
    }

    public static function getPrefixInputHidden(): string
    {
        return "";
    }

    /**
     * Service which will be responsible for creation edition and deletion
     */
    abstract public static function getBaseService(): string;

    /**
     * for filtration and insertion and displaying
     * thanks for comment
     */
    abstract public static function getDynamicParentKey(): string;
}
