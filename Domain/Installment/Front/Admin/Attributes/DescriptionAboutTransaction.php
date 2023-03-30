<?php

namespace App\Domain\Installment\Front\Admin\Attributes;

use App\Domain\Core\File\Interfaces\FactoryFileInterface;
use App\Domain\Core\File\Models\Livewire\FileLivewireCreatorFullyEmpty;
use App\Domain\Core\File\Models\Livewire\FileLivewireWithoutActionFilterBy;
use App\Domain\Core\File\Models\Livewire\LivewireDynamic;
use App\Domain\Core\Front\Admin\Attributes\Containers\ConcatenateHtml;
use App\Domain\Core\Front\Admin\Attributes\Containers\Container;
use App\Domain\Core\Front\Admin\Attributes\Containers\ContainerColumn;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalContainer;
use App\Domain\Core\Front\Admin\Attributes\Containers\ModalCreator;
use App\Domain\Core\Front\Admin\Attributes\Text\Text;
use App\Domain\Core\Front\Admin\Button\ModelInRunTime\Button;
use App\Domain\Core\Front\Interfaces\HtmlInterface;
use App\Domain\Installment\Front\Nested\TransactionIndex;

class DescriptionAboutTransaction implements HtmlInterface, FactoryFileInterface
{
    public $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function generateHtml(): string
    {
        return ConcatenateHtml::new([
            ModalCreator::new(new ButtonShow(),
                ModalContainer::new([], [
                    ContainerColumn::new([
                        'class' => "bg-white p-10 rounded",
                        "@click.away" => "show = false"
                    ],
                        [
                            Text::new(__("История платежей"), [
                                'class' => 'text-center  text-black_custom text-2xl font-bold'
                            ]),
                            new LivewireDynamic(
                                new FileLivewireWithoutActionFilterBy(
                                    static::className(),
                                    $this->transaction(),
                                    false)
                            ),
                            Container::new([
                                'class' => "self-end"
                            ], [
                                Button::new("Назад", [
                                    'class' => "btn btn-xs",
                                    "@click" => 'show = false'
                                ]),
                            ]),
                        ]
                    )
                ])),
        ])->generateHtml();
    }

    static protected function className()
    {
        return "TakenCreditShow";
    }

    static function classEntity()
    {
        return TransactionIndex::class;
    }

    protected function transaction()
    {
        return static::classEntity()::new($this->entity);
    }

    static public function createFiles()
    {
        new FileLivewireCreatorFullyEmpty(
            static::className(),
            static::classEntity()::new());
    }
}
