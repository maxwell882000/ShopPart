<?php

namespace App\Domain\Core\Front\Admin\Attributes\Excel;

use App\Domain\Core\Front\Admin\Attributes\Containers\BoxTitleContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Button\ModelInCompelationTime\ButtonDaisy;
use App\Domain\Core\Front\Admin\Form\Attributes\Models\Input\InputFileRawAttribute;
use App\Domain\Core\Front\Interfaces\HtmlInterface;

class ExcelAttribute implements HtmlInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function generateHtml(): string
    {
        return Container::generate([
            'class' => 'flex flex-row justify-end w-full my-4'
        ], [
            ModalCreator::new(
                ButtonDaisy::new("Загрузить Excel", [
                    '@click' => "open()",
                    "wire:key" => sprintf("%sexcel%s", $this->key, "modal"),
                    "class" => "self-start mt-4 btn-sm btn-accent"
                ]),
                ModalContainer::new([], [
                    Container::new([
                        "@click.away" => "show = false",
                        "class" => "w-[50vw] rounded"
                    ], [
                        BoxTitleContainer::newTitle("Загрузите файл", "rounded", [
                            Container::new([], [
                                new  InputFileRawAttribute("Файл", "unqiue_file_id" . $this->key),
                            ]),
                        ])
                    ])
                ]),
                [
                    'class' => "flex flex-row justify-start"
                ]
            )//                ButtonDaisy::new("Загрузить Excel", ['class' => 'btn-accent'])
        ]);
    }
}
