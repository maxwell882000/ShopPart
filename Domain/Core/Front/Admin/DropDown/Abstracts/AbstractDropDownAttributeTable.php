<?php

namespace App\Domain\Core\Front\Admin\DropDown\Abstracts;

use App\Domain\Core\Front\Admin\DropDown\Items\DropItem;
use App\Domain\Core\Front\Admin\Form\Attributes\Base\BaseDropDownAttribute;
use App\View\Components\DropDown\DropDownComponent;

abstract class AbstractDropDownAttributeTable extends BaseDropDownAttribute
{
    public string $model;

    public function __construct(array $items, $model, $name = null)
    {
        parent::__construct($items, $name);
        $this->model = $model;
        $this->attributes['wire:model'] = $this->model . $this->key;
        $this->attributes['wire:key'] = $this->key . '__' . 'drop_down';
    }

    static public function generateItems(array $items): array
    {
        $response = [];
        foreach ($items as $key => $item) {
            array_push($response, new DropItem($key, $item));
        }
        return $response;
    }

    static public function getDropDown($name = null): AbstractDropDown
    {
        // TODO: Implement getDropDown() method.
    }

    abstract static public function generate($model, $name = null);

    public function generateHtml(): string
    {
        $drop = new DropDownComponent($this, $this->attributes);
        return $drop->render()->with($drop->data())->render();
    }


}
