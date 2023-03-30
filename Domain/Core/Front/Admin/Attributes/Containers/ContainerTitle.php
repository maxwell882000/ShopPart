<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class ContainerTitle extends Container
{
    public string $title;

    static public function newTitle(string $title, string $class = '', array $items = [])
    {
        $object = self::newClass($class, $items);
        $object->title = $title;
        return $object;
    }

    public function generateHtml(): string
    {
        return sprintf(
            "
            <div %s>
            <span class='font-bold text-[1.09rem]'>{{__('%s')}}</span>
                %s
            </div>", $this->generateAttributes(), $this->title, $this->generateItems());
    }
}
