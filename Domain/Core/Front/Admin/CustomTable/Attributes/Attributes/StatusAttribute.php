<?php


namespace App\Domain\Core\Front\Admin\CustomTable\Attributes\Attributes;


use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\BaseAttributes;
use App\Domain\Core\Front\Admin\Livewire\Functions\Interfaces\FunctionStandardTemplate;
use App\Domain\Core\Text\Traits\CaseConverter;
use App\View\Components\Status\StatusComponent;

class StatusAttribute extends BaseAttributes
{
    use  CaseConverter;

    public string $click_name;

    public function __construct($entity, $key, $click_name)
    {
        $this->click_name = $click_name;
        parent::__construct($entity, $key);
    }

    public function generateHtml(): string
    {
        $click = sprintf(
            "%s('%s')",
            $this->click_name,
            $this->entity->id);
        $name = new StatusComponent($this->getValueOfMainKey(), $click);
        return $name->render()->with($name->data())->render();
    }

}
