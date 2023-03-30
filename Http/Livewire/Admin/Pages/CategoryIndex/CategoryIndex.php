<?php
// namespace  will start with
namespace App\Http\Livewire\Admin\Pages\CategoryIndex;  // 1  --- namespace

use App\Http\Livewire\Admin\Base\Abstracts\BaseLivewire;
//2 --- classname livewire
class CategoryIndex extends BaseLivewire
{

    

 public function activateChosen(){return $this->getEntity()::whereIn('id', $this->checkBox)
            ->update(
                ['status' => true]
            );
        $this->checkBox = [];} public function deactivateChosenItem(){return $this->getEntity()::whereIn('id', $this->checkBox)
            ->update(
                ['status' => false]
            );
        $this->checkBox = [];}
   public function statusTable($arg){ $entity = $this->getEntity()::find($arg);
             $entity->status = !$entity->status;
             $entity->save();}  public function reorder(){return \App\Domain\Category\Front\Admin\Functions\DraggableFunction::reorder($this,...func_get_args());} //3   --- set of functions and variables
    public function getPath()
    {
        return 'livewire.admin.pages.category-index.category-index'; //4  --- path to blade
    }

    public function getVariable()
    {
        $this->includeSearch();
        $table = $this->getTable();
        return [
            "table" => new $table($this->getLists()),
              //5   --- variable to blade
        ];
    }
    public function getItemsToOptionalDropDown():array{
        return [
            new \App\Domain\Core\Front\Admin\DropDown\OptionalItems\DeactivateChooseItem(),new \App\Domain\Core\Front\Admin\DropDown\OptionalItems\ActivateChooseItem(), // 6  --- optional dropdown items
        ];
    }
    public function getTable(){
        return 'App\Domain\Category\Front\Admin\CustomTable\Tables\CategoryTable'; //7  --- class name of table
    }

    public function getEntity(){
        return 'App\Domain\Category\Front\Main\CategoryIndex'; //8  --- class name of entity
    }



}
