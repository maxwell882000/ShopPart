<?php

namespace App\Domain\Core\File\Models\Livewire;

class FileLivewireNestedWithoutEntity extends FileLivewireNested
{
    public function generateHtml(): string
    {

        return sprintf("<livewire:admin.pages.%s.%s
                keyToAttach='%s'
                dispatchClass='%s'
                additionalAction='%s'
                />",
            $this->classNameBlade,
            $this->getBladeName(),
            $this->entity->key_to_attach,
            $this->getDispatchClass(),
            $this->getAdditionalActionsClass()
        );
    }

    protected function getPathFromClass(): string
    {
        return self::TEMPLATE_CLASS_PATH . self::CLASS_TEMPLATE_NESTED_WITHOUT;
    }

    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE_NESTED_WITHOUT;
    }
}
