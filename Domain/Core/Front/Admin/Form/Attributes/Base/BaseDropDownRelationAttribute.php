<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireRelatedItem;
use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;

abstract class BaseDropDownRelationAttribute extends BaseDropDownSearchAttribute
{
    const DROP_ITEM = DropLivewireRelatedItem::class;

    public static function getDropItem(): string
    {
        return self::DROP_ITEM;
    }

    public string $dropDownAssociatedClass;
    /**
     * dispatch class for some events
     * Must extend Dispatch class
     * and it will take the object of the livewire component
     * to dispatch some event
     */
    public string $dispatch;

    /*
     *  about key
     *  it will be initial point if you gonna edit
     *  so parent object must have the key of child
     *  hence, entity will call necessary method to set initial value for
     *  dropdowns
     * */
    public static function dynamicSearchRelation(string $searchByKey,
                                                 string $searchLabel,
                                                 string $dropDownAssociatedClass,
                                                 string $dispatch = Dispatch::class,
                                                 bool   $create = true,
                                                 array  $filterBy = [])
    {
        $object = parent::dynamicSearch($searchByKey, $searchLabel, $create, $filterBy);
        $object->dropDownAssociatedClass = $dropDownAssociatedClass;
        $object->dispatch = $dispatch;
        return $object;
    }

    public static function newRelation(string $searchByKey,
                                       string $searchLabel,
                                       string $dropDownAssociatedClass,
                                       string $dispatch = Dispatch::class,
                                       bool   $create = true,
                                       array  $filterBy = [])
    {
        $object = parent::new($searchByKey, $searchLabel, $create, $filterBy);
        $object->dropDownAssociatedClass = $dropDownAssociatedClass;
        $object->dispatch = $dispatch;
        return $object;
    }

    public function additionalParamsHtml(): string
    {
        return sprintf("
        dropDownAssociatedClass='%s'
        dispatchClass='%s'
        ", $this->dropDownAssociatedClass,
            $this->dispatch);
    }

    abstract static public function getDropDownSearch($initial, array $filterBy);

    public function componentBladeName(): string
    {
        return "livewire:components.drop-down.drop-down-search-with-relation";
    }
}
