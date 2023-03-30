<?php

namespace App\Domain\Dashboard\Front\Attributes;

use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerColumn;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerRow;
use App\Domain\Core\Front\Admin\Attributes\FontIcon\FontIconAttribute;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\Traits\GenerateTagAttributes;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class StatisticAttribute implements HtmlInterface
{
    use GenerateTagAttributes, AttributeGetVariable;

    public string $icon;
    public string $all_counter;
    public string $today_counter;
    public string $title;
    public array $attribute_today;
    public array $attribute_all;

    public function __construct(string $icon,
                                string $counter,
                                string $today_counter,
                                string $title,
                                array  $attributes,
                                array  $attribute_today = [],
                                array  $attribute_all = [])
    {
        $this->icon = $icon;
        $this->all_counter = $counter;
        $this->title = $title;
        $this->today_counter = $today_counter;
        $this->attributes = $attributes;
        $this->attribute_all = $attribute_all;
        $this->attribute_today = $attribute_today;
    }

    public static function new(string $icon, string $all_counter, string $today_counter, string $title, array $attributes = [])
    {
        return new static($icon, $all_counter, $today_counter, $title, $attributes);
    }

    public static function newLink(string $icon,
                                   string $all_counter,
                                   string $today_counter,
                                   string $title,
                                   string $link_today,
                                   string $link_all): StatisticAttribute
    {
        return new static(
            $icon, $all_counter,
            $today_counter,
            $title, [],
            $link_today ? [
                "class" => "cursor-pointer hover:text-blue-300",
                "onclick" => sprintf("location.href =\"{{%s}}\"", $link_today)
            ] : [],
            $link_all ? [
                'class' => "cursor-pointer hover:text-blue-300",
                "onclick" => sprintf("location.href =\"{{%s}}\"", $link_all)
            ] : []
        );
    }

    protected function firstKey()
    {
        return "Всего";
    }

    protected function secondKey()
    {
        return "Сегодня";
    }

    public function generateHtml(): string
    {
        return ContainerRow::generate(
            self::append($this->attributes, ['class' => "space-x-6 p-5 items-center "]),
            [
                FontIconAttribute::new([
                    'class' => $this->icon . ' text-4xl text-[#bebebe]'
                ]),
                ContainerColumn::new([
                    'class' => "space-y-0.5 items-start"
                ], [
                    Text::new(self::lang($this->title), [
                        'class' => "text-sm text-center font-bold"
                    ]),
                    Container::new([
                        'class' => "text-sm"
                    ], [
                        Container::new($this->attribute_all, [
                            Text::new(self::lang($this->firstKey()) . ":", []),
                            Text::new(self::getScope($this->all_counter), [
                                "class" => "font-bold"
                            ]),
                        ]),
                        Container::new($this->attribute_today, [
                            Text::new(self::lang($this->secondKey()) . ":", []),
                            Text::new(self::getScope($this->today_counter), [
                                "class" => "font-bold"
                            ]),
                        ]),

                    ])

                ])
            ]);
    }
}
