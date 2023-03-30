<?php

namespace App\Domain\Core\Front\Admin\Attributes\Containers;

class ModalContainer extends Container
{
    public function generateHtml(): string
    {
        $this->attributes['x-show'] = "show";
        $view = view("components.helper.modal.modal_base", [
            "slot" => $this->generateItems()
        ]);
        return sprintf("<div x-cloak %s>%s</div>",
            $this->generateAttributes(),
            $view->render()
        );
//        return sprintf("<div x-cloak %s><x-helper.modal.modal_base>%s</x-helper.modal.modal_base></div>",
//            $this->generateAttributes(),
//        );

    }
}
