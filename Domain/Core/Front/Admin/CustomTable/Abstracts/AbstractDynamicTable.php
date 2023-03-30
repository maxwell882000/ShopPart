<?php

namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;

use App\Domain\Core\Front\Admin\Attributes\FontIcon\IconAdd;
use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\Attributes\Models\EmptyAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Actions\Base\AllActions;
use App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes\TextAttribute;
use App\Domain\Core\Front\Admin\CustomTable\Traits\InputGenerator;

/**
 * there is convention give attribute name like realname_tablename
 * so realname must be followed by hyphen
 */
abstract class  AbstractDynamicTable extends BaseTable
{
    use InputGenerator;

    const ADD_FUNCTION = 'save';
    public array $inputs;
    public string $storedVariants;

    public function __construct($entities = [])
    {
        parent::__construct($entities);
        $this->columns = [
            Column::new(__("ID"), "id-index"),
            ...$this->getColumns(),
            Column::new(__("Действия"), "actions")
        ];
        $inputs = [
            'id' => TextAttribute::generation($this, 'Новый', true),
            'actions' => AllActions::generation([
                ...$this->getActions(),
                $this->addIcon()
            ])
        ];
        $this->inputs = array_merge($inputs, $this->getInputs());
    }

    protected function addIcon(): IconAdd
    {
        return IconAdd::new([
            'wire:click' => self::ADD_FUNCTION
        ]);
    }

    public function getActions()
    {
        return [
            EmptyAttribute::new()
        ];
    }

    public function generateHtml(): string
    {
        return sprintf('<x-%s
                :collection="$collection"
                :table="$table"
                :storedValues="$storedValues"
                :optional="$optional">%s</x-%s>', $this->pathToBlade(), $this->slot(), $this->pathToBlade());
    }

    protected function pathToBlade(): string
    {
        return "helper.table.table_dynamic";
    }

    public function getInputsByKey($name): string
    {
        $real_attribute = explode('-', $name);
        return trim(preg_replace('/\s\s+/', ' ', $this->inputs[$real_attribute[0]]));
    }

    abstract public function getInputs(): array;
}
