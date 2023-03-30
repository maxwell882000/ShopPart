<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconAdd;
use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconDelete;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\ButtonGreenLivewire;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\ButtonRedLivewire;
use App\Domain\Core\Front\Admin\DropDown\OptionalItems\ActivateChooseItem;
use App\Domain\Core\Front\Admin\Livewire\AdditionalActions\Base\AdditionalActions;
use App\Domain\Core\Front\Admin\Livewire\Dispatch\Base\Dispatch;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireOptionalDropDown;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireComponents;

trait TableNested
{
    // the method which will be called to detach or attach the objects
    // get to arguments one is actual id could be the array of id or just id
    // and second  the status (true is attach , false detach)
    public string $key_to_attach;

    public string $title_for_table;
//    this is required for filtering data in nested component
//    so we get all records that belongs to parent
//   filterBy = [ $key_to_filter => parent_id ]
//  The foreignkey of parent
    public string $key_to_filter;

    /**
     * dispatch actions needed for dispatching events
     * called differently for different classes
     * for drop down its called when child entity was choosen
     * for others its called after each time when access to server was made
     */
    public string $dispatch_class;

    /**
     * specifically needed for nested class only
     * actions after entity was removed or added
     * */
    public string $additional_actions;

    static public function generate($key_to_attach, $title_for_table, $key_to_filter)
    {
        $new = new self();
        $new->key_to_attach = $key_to_attach;
        $new->title_for_table = $title_for_table;
        $new->key_to_filter = $key_to_filter;
        return $new;
    }

    static public function generateWithoutEntity($key_to_attach, $title_for_table, $dispatch = Dispatch::class, $additional = AdditionalActions::class)
    {
        $new = new self();
        $new->key_to_attach = $key_to_attach;
        $new->title_for_table = $title_for_table;
        $new->dispatch_class = $dispatch;
        $new->additional_actions = $additional;
        return $new;
    }

    abstract public function getTableClass(): string;

    abstract public function tableDeclineClass(): string;

    public function livewireComponents(): LivewireComponents
    {
        return new AllLivewireComponents([
        ]);
    }


    /// accept drop down
    public function livewireOptionalDropDown(): AllLivewireOptionalDropDown
    {
        return new AllLivewireOptionalDropDown([
            ActivateChooseItem::create("status")
        ]);
    }


    public function liviwireOptionalDropDownDecline(): AllLivewireOptionalDropDown
    {
        return new AllLivewireOptionalDropDown([

        ]);
    }

    public function livewireFunctions(): LivewireAdditionalFunctions
    {
        return AllLivewireFunctions::generation([

        ]);
    }

    public function getDeclineButtonAttribute(): string
    {
        return IconDelete::new([
            "wire:click" => "removeSpecific(`" . $this->id . "`)"
        ])->generateHtml();
//        return (new ButtonRedLivewire(__("Удалить"),
//            "removeSpecific(" . $this->id . ")"))->generateHtml();
    }

    public function getAcceptButtonAttribute(): string
    {
        return IconAdd::new([
                "wire:click" => "addSpecific(`" . $this->id . "`)"
            ]
        )->generateHtml();
//        return (new ButtonGreenLivewire(__("Добавить"),
//            "addSpecific(" . $this->id . ")"))->generateHtml();
    }
}
