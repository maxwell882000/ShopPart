<?php

namespace App\Domain\Core\File\Models\Livewire;

use App\Domain\Core\File\Interfaces\LivewireCreatorNestedInterface;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Admin\Livewire\AdditionalActions\Base\AdditionalActions;

class FileLivewireNested extends FileLivewireCreator implements LivewireCreatorNestedInterface
{
    use AttributeGetVariable;

    public function generateHtml(): string
    {

        return sprintf("<livewire:admin.pages.%s.%s
                :attachEntityId='%s'
                :attachEntity='get_class(%s)'
                keyToAttach='%s'
                :filterBy='[\"%s\" => \"%s\"]'
                dispatchClass='%s'
                additionalAction='%s'
                />",
            $this->classNameBlade,
            $this->getBladeName(),
            $this->getWithoutScopeAtrVariable("id"),
            $this->getEntityVariable(),
            $this->entity->key_to_attach,
            $this->entity->key_to_filter,
            $this->getWithoutScopeAtrVariable("id"),
            $this->getDispatchClass(),
            $this->getAdditionalActionsClass()
        );
    }

    protected function getPathFromClass(): string
    {
        return self::TEMPLATE_CLASS_PATH . self::CLASS_TEMPLATE_NESTED;
    }

    protected function getPathFromBlade(): string
    {
        return self::TEMPLATE_BLADE_PATH . self::BLADE_TEMPLATE_NESTED;
    }

    protected function getAdditionalActionsClass(): string
    {
        return $this->entity->additional_actions ?? AdditionalActions::class;
    }

    protected function formatClass($file_from): string
    {
        return sprintf($file_from,
            $this->getNamespace(),
            $this->getLivewireClassName(),
            $this->getFunctions(),
            $this->getBladePath(),
            $this->initializeVariables(),
            $this->getOptionalDropItems(),
            $this->getOptionalDropItemsDecline(),
            $this->getTableClass(),
            $this->getEntityClass(),
            $this->getTableDeclineClass(),
        );
    }

    protected function getOptionalDropItemsDecline(): string
    {
        return $this->entity->liviwireOptionalDropDownDecline()->generateDropItems();
    }

    protected function formatBlade($file_from): string
    {
        return sprintf($file_from,
            $this->entity->title_for_table,
            $this->getFunctionComponents(),
            $this->getTableToBlade()
        );
    }

    public function getTableDeclineClass(): string
    {
        return $this->entity->tableDeclineClass();
    }
}
