<?php

namespace App\Http\Livewire\Admin\Base\Abstracts;

use App\Domain\Core\Front\Admin\DropDown\Items\DropLivewireItem;
use App\Domain\Core\Front\Admin\DropDown\Models\DropDownOptional;
use App\Domain\Core\Front\Admin\Livewire\AdditionalActions\Base\AdditionalActions;
use Symfony\Component\Console\Helper\Table;

/**
 * accepts @params
 *  $attachEntityId -- main entity which the other entities would be attached
 *  $keyToAttach    -- the key which must be called attach to main entity
 *  $attachEntity   -- attach entity class
 *  both passed in blade
 *
 *  $additionalAction -- additional class for adding additional actions each time when
 *                       user adds or removes entities from the list
 */
abstract class BaseLivewireNested extends BaseLivewire
{
    const DETACH = 0;
    const ATTACH = 1;
    public bool $isAcceptMode = true;
    public $attachEntityId;
    public string $attachEntity;
    public string $keyToAttach;
    public string $additionalAction = AdditionalActions::class;

    public function checkAll()
    {
        if ($this->isAcceptMode) {
            $this->checkBox = $this->getListAccept()->pluck('id')->toArray();
        } else {
            parent::checkAll();
        }
    }

    public function changeToAdd()
    {
        $this->isAcceptMode = true;
        $this->checkBox = [];
    }

    public function changeToRemove()
    {
        $this->isAcceptMode = false;
        $this->checkBox = [];

    }

    public function getTableToBlade()
    {
        if ($this->isAcceptMode) {
            return $this->getAcceptTableBlade();
        }
        return $this->getDeclineTableBlade();
    }

    public function getOptionalDropDown(): DropDownOptional
    {
        return new  DropDownOptional(
            $this->getItemsToOptionalDropDown()
        );
    }

    protected function getListAccept()
    {
        $entity = $this->getEntity();
        $withOutSearch = collect($this->filterBy);// original filterBy except there is no search values
        $filterBy = [$this->keySearch => $withOutSearch->pull($this->keySearch)];
        return $entity::filterByNot($withOutSearch->toArray())
            ->filterBy($filterBy)
            ->paginate($this->paginate);
    }

    private function getAcceptTableBlade()
    {
        $table = $this->getTable();
        return new $table($this->getListAccept());
    }

    private function getDeclineTableBlade()
    {
        $table = $this->getTableDecline();
        return new $table($this->getLists());

    }

    public function getItemsToOptionalDropDown(): array
    {
        if ($this->isAcceptMode) {
            return [
                new DropLivewireItem(__("Добавить все отмечанные"), "acceptAllChecked"),
                ...$this->getItmsToDropDownAccept()
            ];
        } else {
            return [
                new DropLivewireItem(__("Удалить все отмечанные"), "removeAllChecked"),
                ...$this->getItmsToDropDownDecline()
            ];
        }
    }

    abstract public function getItmsToDropDownAccept(): array;

    abstract public function getItmsToDropDownDecline(): array;

    public function acceptAllChecked()
    {
        $this->addToEntity($this->checkBox);
    }

    public function removeAllChecked()
    {
        $this->removeFromEntity($this->checkBox);
    }

    protected function addToEntity($adding)
    {

        $this->additionalAction::add($this, $adding);
        $entity = $this->getAttachEntity();
        $keyToAttach = $this->keyToAttach;
        $entity->$keyToAttach($adding, self::ATTACH);
    }

    protected function removeFromEntity($removing)
    {
        $this->additionalAction::delete($this, $removing);
        $entity = $this->getAttachEntity();
        $keyToAttach = $this->keyToAttach;
        $entity->$keyToAttach($removing, self::DETACH);
    }

    public function removeSpecific($id)
    {
        $this->removeFromEntity($id);
    }

    public function addSpecific($id)
    {
        $this->addToEntity($id);
    }

    private function getAttachEntity()
    {
        return $this->attachEntity::find($this->attachEntityId);
    }

    // use traits to reduce redundancy of code;
    abstract public function getTableDecline(): string;


}
