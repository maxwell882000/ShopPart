<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Base;

use App\Domain\Core\Front\Admin\CustomTable\Attributes\Abstracts\BaseAttributes;
use App\Domain\Core\Front\Admin\Form\Traits\AttributeGetVariable;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use function Symfony\Component\Translation\t;

// difference between attributes in custom table and from
// that in custom table attributes generated in run time
// but in form they are generated at creation time
// everything will be simpler here because in each blade the variable called is the same
// so I just need gave the name to calling attribute
// sprintf('$entity->%s', $key);
abstract class BaseAttributeForm implements HtmlInterface
{
    use AttributeGetVariable;

    public string $id = "";
    public string $label;
    public string $key;
    protected string $create;

    public function __construct(string $key, string $label, bool $create = true, string $id = "")
    {
        $this->key = $key;
        $this->label = $label;
        $this->create = $create;
        $this->id = $id == "" ? $this->key : $id;
    }

    protected function getVariable(): string
    {
        return $this->getWithoutScopeAtrVariable($this->key) . ' ?? " "';
    }
}
