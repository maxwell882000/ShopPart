<?php

namespace App\Http\Livewire\Admin\Base\Rules;

trait GenerateRules
{
    public array $rules = [];

    private function generateRules($parent)
    {
        $this->baseGenerateRules($parent, $this->getEntity()::getRules());
    }

    private function baseGenerateRules($parent, $rules = [])
    {
        $new_rules = [];
        foreach ($rules as $key => $value) {
            $new_rules[$parent . $key] = $value;
        }
        $this->rules = array_merge($this->rules, $new_rules);
    }

}
