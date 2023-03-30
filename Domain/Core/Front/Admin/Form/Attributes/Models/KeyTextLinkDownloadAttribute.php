<?php

namespace App\Domain\Core\Front\Admin\Form\Attributes\Models;
/*
 *  here value is  helper  text
 *
 * **/

class KeyTextLinkDownloadAttribute extends KeyTextLinkAttribute
{
    protected function value(): string
    {
        return $this->value;
    }

    protected function generateLink()
    {
        return sprintf("route(\"download.file\", [\"path\"=> %s])",
            $this->getWithoutScopeAtrVariable($this->link . "->path"));
    }

}
