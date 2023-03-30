<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Abstracts;


use App\Domain\Core\Front\Admin\Attributes\Models\Column;
use App\Domain\Core\Front\Admin\CustomTable\Interfaces\TableInterface;
use App\Domain\Core\Front\Admin\Livewire\Functions\Base\AllLivewireComponents;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\LivewireAdditionalFunctions;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

abstract class AbstractTable extends BaseTable
{
    public function __construct($entities = [])
    {
        parent::__construct($entities);
        $this->columns = [...$this->getColumns(), Column::new(__("Действия"), "actions")];
    }


}
