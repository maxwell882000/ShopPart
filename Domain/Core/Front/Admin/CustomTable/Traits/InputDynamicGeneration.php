<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Traits;

use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconBack;
use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconEdit;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\ButtonGrayLivewire;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\ButtonGreenLivewire;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Traits\SetInputAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Errors\DynamicTableException;
use phpDocumentor\Reflection\Types\Static_;

trait InputDynamicGeneration
{
    use SetInputAttribute;

    public array $inputs = [];

    public static function getCustomRules(): array
    {
        return [];
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }


    /**
     * start editing already created entities
     **/

    public function getInputs($name)
    {
        $real_attribute = explode('-', $name);
        if (empty($this->inputs)) {
            $this->inputs['id'] = TextAttribute::generation($this, $this->getPrimaryKey());
            $this->generateInput();
            $this->inputs['actions'] = AllActions::generation([
                IconEdit::new(["wire:click" => "update(`" . $this->id . "`)"]),
                IconBack::new(["wire:click" => "cancel(`" . $this->id . "`)"])
            ]);
        }
        return $this->inputs[$real_attribute[0]];
    }

    protected function generateInput()
    {
        try {
            $input = $this->generateNewWay(static::getCustomRules());
        } catch (DynamicTableException $exception) {
            $input = $this->generateOldWay($this->getRules());
        }
        $this->inputs = array_merge($this->inputs, $input);
    }


}
