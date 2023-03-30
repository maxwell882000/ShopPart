<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Front\Admin\DropDown\CategoryDropDownSearch;
use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDownSearch;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\BaseDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Form\Traits\GetDropDown;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class BaseDropDownSearchAttribute extends AbstractDropDownSearch implements HtmlInterface
{
    use AttributeGetVariable, GetDropDown, GenerateTagAttributes;

    const  DROP_ITEM = DropItem::class;
    protected string $searchLabel;
    protected string $searchByKey;
    protected bool $create;
    protected array $filterBy;

    public static function getDropItem(): string
    {
        return self::DROP_ITEM;
    }

    public static function dynamicSearch(string $searchByKey,
                                         string $searchLabel,
                                         bool   $create = true,
                                         array  $filterBy = [],
                                                ...$additonal)
    {
        $object = self::new($searchByKey, $searchLabel, $create, $filterBy, $additonal);
        $object->searchByKey = $searchByKey;
        return $object;
    }

    public static function new(string $searchByKey,
                               string $searchLabel,
                               bool   $create = true,
                               array  $filterBy = [],
                               array  $attributes = [])
    {
        $self = get_called_class();
        $class = new $self([]);
        $class->attributes = $attributes;
        $class->searchByKey = sprintf("\"%s\"", $searchByKey);
        $class->searchLabel = $searchLabel;
        $class->create = $create;
        $class->filterBy = $filterBy;
        return $class;
    }

    public function generateHtml(): string
    {
        $dropDownClass = get_called_class();
        return sprintf(
            "<%s
            :searchByKey='%s'
            dropDownClass='%s'
            %s
            searchLabel='%s'
            %s
            %s
             />",
            $this->componentBladeName(),
            $this->searchByKey,
            $dropDownClass,
            !$this->create ? ":initial='" . $this->getWithoutScopeAtrVariable($this->key) . "'" : '',
            $this->searchLabel,
            $this->generateAttributes(),
            $this->additionalParamsHtml()
        );
    }

    public function componentBladeName(): string
    {
        return 'livewire:components.drop-down.drop-down-search';
    }

    public function additionalParamsHtml(): string
    {
        return "";
    }

    /**
     * attribute -- what will be displayed to user
     * key --- is what will be assigned to entity
     */


}
