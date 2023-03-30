<?php

namespace App\Domain\Category\Front\Admin\DropDown;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractDropDown;
use App\Domain\Core\Front\Admin\DropDown\Abstracts\AbstractLivewireDropDown;
use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireItem;

class DepthDropDown extends AbstractLivewireDropDown
{
    const TO_TEXT = [
        0 => "Все слои",
        1 => "Главный слой",
        2 => "Второй слой",
        3 => "Третий слой",
        4 => "Четвертый слой",
        self::LAST => "Только последний слой"
    ];
    const LAST = 1000;

    public static function filterBy($object)
    {
        if ($object->depth == self::LAST) {
            $object->filterBy['height'] = 0;
        } else if ($object->depth)
            $object->filterBy['depth'] = $object->depth;
        else {
            unset($object->filterBy['depth']);
        }

    }

    protected function getTemplate()
    {
        return self::FUNCTION_BODY_NO_RETURN;
    }

    protected function setBodyFunction(): string
    {
        return parent::setBodyFunction() . "\n" .
            sprintf('\\%s::filterBy($this);', self::class);
    }

    function setName(): string
    {
        return __("Выберите слой");
    }

    static public function getDropDown($name = null): AbstractDropDown
    {

        try {
            $depth = Category::orderBy("depth", "DESC")->first()->depth ?? 0;
            $items = [];
            for ($i = 0; $i <= $depth; $i++) {
                $items[] = new DropLivewireItem(
                    self::TO_TEXT[$i],
                    self::formatClick($i)
                );
            }
            $items[] = new DropLivewireItem(
                self::TO_TEXT[self::LAST],
                self::formatClick(self::LAST)
            );
            return new static($items, $name == null || gettype($name) == "NULL" || $name == "" ? null : __(self::TO_TEXT[$name]));
        } catch (\Exception $exception) {
            throw  new \Exception(gettype($name));
        }

    }

    static public function getVariable(): string
    {
        return "depth";
    }

    static public function getVariableBlade(): string
    {
        return "depth_drop_down";
    }

    static public function getFunctionName(): string
    {
        return "setDropDown";
    }

    static public function getArguments(): array
    {
        return [
            'depth'
        ];
    }
}
