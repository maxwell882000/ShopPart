<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireEmptyCreator extends FileLivewireCreator
{
    const BLADE_EMPTY = "base-empty-template.blade.php";
    const CLASS_EMPTY = "BaseEmptyLivewire.txt";

    protected function getPathFromClass(): string
    {
        return self::TEMPLATE_CLASS_PATH . self::CLASS_EMPTY;
    }

    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . self::BLADE_EMPTY;
    }


    protected function formatBlade($file_from): string
    {
        return sprintf($file_from,
            $this->entity->generateAttributes()->generateHtml()
        );
    }

    protected function formatClass($file_from): string
    {
        return sprintf($file_from,
            $this->getNamespace(),
            $this->getLivewireClassName(),
            $this->getFunctions(),
            $this->getBladePath(),
            $this->initializeVariables());
    }
}
