<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconDelete;
use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconEdit;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\InputTableAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException;

trait   FrontDynamicGeneration
{
    public array $front_attribute = [];

    public function getCustomFrontRules(): array
    {
        return [];
    }

    /**
     * to show already created entites
     */
    public function getFrontAttributes($name)
    {
        $real_attribute = explode('-', $name);
        if (empty($this->front_attribute)) {
            $this->front_attribute['id'] = TextAttribute::generation($this, 'id');
            $this->generateAttributes();
            $this->front_attribute['actions'] = $this->getActionsAttribute();
        }
        return $this->front_attribute[$real_attribute[0]];
    }

    /***
     * get button actions for Actions column
     */
    public function getActionsAttribute(): string
    {
        return AllActions::generation([
            ...$this->getAddingCustomActions(),
            $this->getEditButton(),
            $this->getRemoveButton()
        ]);
    }

    public function getEditButton()
    {
        return IconEdit::new([
            'wire:click' => sprintf("addToUpdate(`%s`)", $this->id),
        ]);
//        return ButtonGreenLivewire::new(__("Изменить"), );
    }

    public function getRemoveButton()
    {
        return IconDelete::new([
            'wire:click' => sprintf("delete(`%s`)", $this->id)
        ]);
//        return ButtonRedLivewire::new(__("Удалить"), );
    }

    protected function generateAttributes()
    {
        $front = [];
        try {
            $front = $this->generateAttributesFromCustomRules($this->getCustomFrontRules());
        } catch (\Exception $exception) {
            $front = $this->generateAttributesFromRules($this->getRules());
        }
        $this->front_attribute = array_merge($this->front_attribute, $front);
    }

    protected function generateAttributesFromCustomRules(array $rules): array
    {
        if (empty($rules)) {
            throw  new DynamicTableException("Custom Rules are not exists");
        }
        $input = [];
        foreach ($rules as $key => $value) {
            $text_html = "";
            if (!$value)
                $text_html = TextAttribute::generation(
                    $this,
                    $key
                );
            else
                $text_html = TextAttribute::generation(
                    $this,
                    $value($this->$key),
                    true
                );
            $input[$key] = $text_html;
        }
        return $input;
    }

    abstract static public function getPrefixInputHidden(): string;

    private function hiddenInputAdd($key): string
    {
        return InputTableAttribute::generate(
            $this->getPrefixInputHidden() . \CR::CR . $this->id . \CR::CR . $key,
            "text",
            "",
            false,
            "",
            "",
            [
                'class' => 'hidden',
                "value" => $this->$key
            ]
        );
    }

    protected function generateAttributesFromRules($rules): array
    {
        $input = [];
        foreach ($rules as $key => $value) {
            $text_html = TextAttribute::generation(
                $this,
                $key
            );
            $input[$key] = $text_html;
        }
        return $input;
    }
}
