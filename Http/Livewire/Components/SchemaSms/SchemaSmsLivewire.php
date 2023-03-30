<?php

namespace App\Http\Livewire\Components\SchemaSms;

use Livewire\Component;

class SchemaSmsLivewire extends Component
{
    public string $selected_class;
    public string $comment = "";
    public $type;

    public function addToComment($value)
    {
        $this->comment = $this->comment . $value;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function save($type)
    {
        $comment = preg_replace("/[\"']/", "", $this->comment);
        $this->selected_class::where('type', $type)->update(['schema' => $comment]);
        session()->flash('success', __("Успешно сохранён"));
    }

    public function render()
    {
        return view(
            'livewire.components.schema-sms.schema-sms-livewire',
            [
                'entities' => $this->selected_class::filterBy([])->get()
            ]
        );
    }
}
